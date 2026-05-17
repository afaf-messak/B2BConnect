<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    public function index()
    {
        return Notification::with('user')->latest()->paginate(10);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $notification = Notification::create($data);

        return response()->json($notification->load('user'), Response::HTTP_CREATED);
    }

    public function show(Notification $notification)
    {
        return $notification->load('user');
    }

    public function update(Request $request, Notification $notification)
    {
        $notification->update($this->validatedData($request, true));

        return $notification->load('user');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return response()->noContent();
    }

    private function validatedData(Request $request, bool $partial = false): array
    {
        $required = $partial ? 'sometimes' : 'required';

        return $request->validate([
            'user_id' => [$required, 'exists:users,id'],
            'type' => ['sometimes', 'string', 'max:255'],
            'title' => [$required, 'string', 'max:255'],
            'body' => [$required, 'string'],
            'data' => ['nullable', 'array'],
            'read_at' => ['nullable', 'date'],
        ]);
    }
}
