<?php

namespace App\Http\Controllers;

use App\Models\DocumentVerification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class DocumentVerificationController extends Controller
{
    public function index()
    {
        return DocumentVerification::with(['user', 'reviewer'])->latest()->paginate(10);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['user_id'] = $request->user()?->id ?? $data['user_id'];

        $documentVerification = DocumentVerification::create($data);

        return response()->json($documentVerification->load(['user', 'reviewer']), Response::HTTP_CREATED);
    }

    public function show(DocumentVerification $documentVerification)
    {
        return $documentVerification->load(['user', 'reviewer']);
    }

    public function update(Request $request, DocumentVerification $documentVerification)
    {
        $documentVerification->update($this->validatedData($request, true));

        return $documentVerification->load(['user', 'reviewer']);
    }

    public function destroy(DocumentVerification $documentVerification)
    {
        $documentVerification->delete();

        return response()->noContent();
    }

    private function validatedData(Request $request, bool $partial = false): array
    {
        $required = $partial ? 'sometimes' : 'required';

        return $request->validate([
            'user_id' => [$request->user() ? 'nullable' : $required, 'exists:users,id'],
            'reviewer_id' => ['nullable', 'exists:users,id'],
            'document_type' => [$required, 'string', 'max:255'],
            'document_path' => [$required, 'string', 'max:255'],
            'status' => ['sometimes', Rule::in(['pending', 'approved', 'rejected'])],
            'rejection_reason' => ['nullable', 'string'],
            'verified_at' => ['nullable', 'date'],
        ]);
    }
}
