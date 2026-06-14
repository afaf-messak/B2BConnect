<?php

namespace App\Http\Controllers;

use App\Models\DocumentVerification;
use App\Models\User;
use App\Support\Navigation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminModerationController extends Controller
{
    public function index(Request $request): View
    {
        $query = DocumentVerification::query()->with('user')->latest();

        if ($status = $request->string('status')->toString()) {
            $query->where('status', $status);
        }

        if ($search = $request->string('q')->trim()->toString()) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('ice', 'like', "%{$search}%");
            });
        }

        $documents = $query->paginate(15)->withQueryString();

        $stats = [
            ['label' => __('common.pending'), 'value' => DocumentVerification::where('status', 'pending')->count()],
            ['label' => __('common.approved'), 'value' => DocumentVerification::where('status', 'approved')->count()],
            ['label' => __('common.rejected'), 'value' => DocumentVerification::where('status', 'rejected')->count()],
        ];

        return view('admin.moderation', [
            'documents' => $documents,
            'filters' => $request->only(['q', 'status']),
            'stats' => $stats,
            'navItems' => Navigation::adminItems('moderation'),
            'navActive' => 'moderation',
            'pageTitle' => __('nav.admin.suppliers_validation'),
            'pageSubtitle' => __('roles.moderation_subtitle'),
        ]);
    }

    public function show(DocumentVerification $document): View
    {
        $document->load('user.supplierProfile');

        return view('admin.moderation-show', [
            'document' => $document,
            'supplier' => $document->user,
            'navItems' => Navigation::adminItems('moderation'),
            'navActive' => 'moderation',
            'pageTitle' => $document->user?->company_name ?: $document->user?->name,
            'pageSubtitle' => __('admin.supplier_review'),
        ]);
    }

    public function approve(DocumentVerification $document): RedirectResponse
    {
        $document->update([
            'status' => 'approved',
            'reviewer_id' => auth()->id(),
            'verified_at' => now(),
            'rejection_reason' => null,
        ]);

        if ($document->user && $document->user->isSupplier()) {
            $document->user->update([
                'account_status' => User::STATUS_ACTIVE,
            ]);
        }

        return back()->with('success', __('roles.supplier_approved'));
    }

    public function reject(Request $request, DocumentVerification $document): RedirectResponse
    {
        $validated = $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        $document->update([
            'status' => 'rejected',
            'reviewer_id' => auth()->id(),
            'verified_at' => null,
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        if ($document->user && $document->user->isSupplier()) {
            $document->user->update([
                'account_status' => User::STATUS_REJECTED,
            ]);
        }

        return back()->with('success', __('roles.supplier_rejected'));
    }
}
