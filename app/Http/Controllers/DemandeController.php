<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class DemandeController extends Controller
{
    public function index()
    {
        return Demande::with('user')->latest()->paginate(10);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['user_id'] = $request->user()?->id ?? $data['user_id'];

        $demande = Demande::create($data);

        return response()->json($demande->load('user'), Response::HTTP_CREATED);
    }

    public function show(Demande $demande)
    {
        return $demande->load(['user', 'orders', 'offres', 'messages']);
    }

    public function update(Request $request, Demande $demande)
    {
        $data = $this->validatedData($request, true);

        $demande->update($data);

        return $demande->load(['user', 'orders', 'offres', 'messages']);
    }

    public function destroy(Demande $demande)
    {
        $demande->delete();

        return response()->noContent();
    }

    private function validatedData(Request $request, bool $partial = false): array
    {
        $required = $partial ? 'sometimes' : 'required';

        return $request->validate([
            'user_id' => [$request->user() ? 'nullable' : $required, 'exists:users,id'],
            'title' => [$required, 'string', 'max:255'],
            'description' => [$required, 'string'],
            'category' => ['nullable', 'string', 'max:255'],
            'quantity' => [$required, 'integer', 'min:1'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'status' => ['sometimes', Rule::in(['pending', 'approved', 'rejected', 'completed'])],
            'needed_at' => ['nullable', 'date'],
        ]);
    }
}
