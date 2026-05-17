<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    public function index()
    {
        return Message::with(['sender', 'receiver', 'demande', 'offre'])->latest()->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['sender_id'] = $request->user()?->id ?? $data['sender_id'];

        $message = Message::create($data);

        return response()->json($message->load(['sender', 'receiver', 'demande', 'offre']), Response::HTTP_CREATED);
    }

    public function show(Message $message)
    {
        return $message->load(['sender', 'receiver', 'demande', 'offre']);
    }

    public function update(Request $request, Message $message)
    {
        $message->update($this->validatedData($request, true));

        return $message->load(['sender', 'receiver', 'demande', 'offre']);
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return response()->noContent();
    }

    private function validatedData(Request $request, bool $partial = false): array
    {
        $required = $partial ? 'sometimes' : 'required';

        return $request->validate([
            'sender_id' => [$request->user() ? 'nullable' : $required, 'exists:users,id'],
            'receiver_id' => [$required, 'exists:users,id'],
            'demande_id' => ['nullable', 'exists:demandes,id'],
            'offre_id' => ['nullable', 'exists:offres,id'],
            'body' => [$required, 'string'],
            'read_at' => ['nullable', 'date'],
        ]);
    }
}
