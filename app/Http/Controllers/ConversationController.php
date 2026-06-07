<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConversationMessageRequest;
use App\Models\Message;
use App\Models\Product;
use App\Models\User;
use App\Support\Navigation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ConversationController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $conversations = $this->conversationsFor($user);
        $navItems = $this->navItemsFor($user, 'messages');

        return view('messages.index', [
            'conversations' => $conversations,
            'activePartner' => null,
            'messages' => collect(),
            'navItems' => $navItems,
            'portalRole' => $user->role,
            'unreadTotal' => $user->unreadMessagesCount(),
        ]);
    }

    public function show(Request $request, User $user): View
    {
        $authUser = $request->user();
        abort_if($user->id === $authUser->id, 404);
        $this->authorizeConversationPartner($authUser, $user);

        $messages = Message::query()
            ->where(function ($query) use ($authUser, $user) {
                $query->where(function ($query) use ($authUser, $user) {
                    $query->where('sender_id', $authUser->id)->where('receiver_id', $user->id);
                })->orWhere(function ($query) use ($authUser, $user) {
                    $query->where('sender_id', $user->id)->where('receiver_id', $authUser->id);
                });
            })
            ->with(['sender', 'receiver'])
            ->oldest()
            ->get();

        Message::query()
            ->where('sender_id', $user->id)
            ->where('receiver_id', $authUser->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $conversations = $this->conversationsFor($authUser);

        return view('messages.index', [
            'conversations' => $conversations,
            'activePartner' => $user,
            'messages' => $messages,
            'navItems' => $this->navItemsFor($authUser, 'messages'),
            'portalRole' => $authUser->role,
            'unreadTotal' => $authUser->fresh()->unreadMessagesCount(),
            'productContext' => $request->integer('product') > 0
                ? Product::query()->find($request->integer('product'))
                : null,
        ]);
    }

    public function store(StoreConversationMessageRequest $request, User $user): RedirectResponse
    {
        $authUser = $request->user();
        abort_if($user->id === $authUser->id, 404);
        $this->authorizeConversationPartner($authUser, $user);

        $body = trim((string) $request->validated('body'));

        if ($request->filled('product_id')) {
            $product = Product::query()->find($request->integer('product_id'));
            if ($product) {
                $body = "Question sur le produit « {$product->name} » (ref #{$product->id}) :\n\n".$body;
            }
        }

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('chat-attachments', 'public');
        }

        if ($body === '' && ! $attachmentPath) {
            return back()->withErrors(['body' => __('messages.body_required')]);
        }

        Message::create([
            'sender_id' => $authUser->id,
            'receiver_id' => $user->id,
            'body' => $body !== '' ? $body : __('marketplace.attachment'),
            'attachment_path' => $attachmentPath,
        ]);

        return redirect()
            ->route('messages.show', $user)
            ->with('success', __('messages.sent'));
    }

    public function poll(Request $request, User $user): JsonResponse
    {
        $authUser = $request->user();
        abort_if($user->id === $authUser->id, 404);
        $this->authorizeConversationPartner($authUser, $user);

        $afterId = $request->integer('after', 0);

        $messages = Message::query()
            ->where(function ($query) use ($authUser, $user) {
                $query->where(function ($query) use ($authUser, $user) {
                    $query->where('sender_id', $authUser->id)->where('receiver_id', $user->id);
                })->orWhere(function ($query) use ($authUser, $user) {
                    $query->where('sender_id', $user->id)->where('receiver_id', $authUser->id);
                });
            })
            ->when($afterId > 0, fn ($q) => $q->where('id', '>', $afterId))
            ->with(['sender', 'receiver'])
            ->oldest()
            ->get()
            ->map(fn (Message $message) => [
                'id' => $message->id,
                'body' => $message->body,
                'sender_id' => $message->sender_id,
                'attachment_url' => $message->attachment_path
                    ? Storage::disk('public')->url($message->attachment_path)
                    : null,
                'time' => $message->created_at->format('H:i'),
                'mine' => $message->sender_id === $authUser->id,
            ]);

        Message::query()
            ->where('sender_id', $user->id)
            ->where('receiver_id', $authUser->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['messages' => $messages]);
    }

    private function conversationsFor(User $user): array
    {
        $messages = Message::query()
            ->where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            })
            ->with(['sender', 'receiver'])
            ->latest()
            ->get();

        return $messages
            ->groupBy(fn (Message $message) => $message->sender_id === $user->id
                ? $message->receiver_id
                : $message->sender_id)
            ->map(function ($thread, $partnerId) use ($user) {
                /** @var Message $latest */
                $latest = $thread->first();
                $partner = $latest->sender_id === $user->id ? $latest->receiver : $latest->sender;
                $unread = $thread
                    ->where('receiver_id', $user->id)
                    ->whereNull('read_at')
                    ->count();

                return [
                    'partner' => $partner,
                    'latest' => $latest,
                    'unread' => $unread,
                ];
            })
            ->sortByDesc(fn (array $conversation) => $conversation['latest']->created_at)
            ->values()
            ->all();
    }

    private function authorizeConversationPartner(User $authUser, User $partner): void
    {
        $allowed = ($authUser->role === 'client' && $partner->role === 'supplier')
            || ($authUser->role === 'supplier' && $partner->role === 'client');

        abort_unless($allowed, 403);
    }

    private function navItemsFor(User $user, string $active): array
    {
        return $user->role === 'supplier'
            ? Navigation::supplierItems($active, $user)
            : Navigation::clientItems($active, $user);
    }
}
