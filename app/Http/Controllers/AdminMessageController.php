<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Services\AdminStatsService;
use App\Support\Navigation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminMessageController extends Controller
{
    public function __construct(private AdminStatsService $stats) {}

    public function index(Request $request): View
    {
        $query = Message::query()->with(['sender', 'receiver'])->latest();

        if ($search = $request->string('q')->trim()->toString()) {
            $query->where('body', 'like', "%{$search}%");
        }

        $messages = $query->paginate(20)->withQueryString();

        return view('admin.messages.index', [
            'messages' => $messages,
            'filters' => $request->only(['q']),
            'navItems' => Navigation::adminItems('messages'),
            'navActive' => 'messages',
            'pageTitle' => __('nav.admin.messages'),
            'pageSubtitle' => __('admin.messages_subtitle'),
            'stats' => [
                ['label' => __('admin.stats.total_messages'), 'value' => Message::count()],
                ['label' => __('admin.stats.unread_messages'), 'value' => Message::whereNull('read_at')->count()],
                ['label' => __('admin.stats.total_conversations'), 'value' => $this->stats->conversationCount()],
            ],
        ]);
    }
}
