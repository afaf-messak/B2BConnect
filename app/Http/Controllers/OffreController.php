<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class OffreController extends Controller
{
    public function index()
    {
        return Offre::with(['user', 'demande'])->latest()->paginate(10);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['user_id'] = $request->user()?->id ?? $data['user_id'];

        $offre = Offre::create($data);

        return response()->json($offre->load(['user', 'demande']), Response::HTTP_CREATED);
    }

    public function show(Offre $offre)
    {
        return $offre->load(['user', 'demande', 'messages']);
    }

    public function update(Request $request, Offre $offre)
    {
        $offre->update($this->validatedData($request, true));

        return $offre->load(['user', 'demande']);
    }

    public function destroy(Offre $offre)
    {
        $offre->delete();

        return response()->noContent();
    }

    private function validatedData(Request $request, bool $partial = false): array
    {
        $required = $partial ? 'sometimes' : 'required';

        return $request->validate([
            'user_id' => [$request->user() ? 'nullable' : $required, 'exists:users,id'],
            'demande_id' => [$required, 'exists:demandes,id'],
            'title' => [$required, 'string', 'max:255'],
            'description' => [$required, 'string'],
            'price' => [$required, 'numeric', 'min:0'],
            'delivery_time_days' => [$required, 'integer', 'min:1'],
            'status' => ['sometimes', Rule::in(['pending', 'accepted', 'rejected', 'expired'])],
        ]);
    }
}
