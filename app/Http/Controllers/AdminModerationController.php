<?php

namespace App\Http\Controllers;

use App\Models\DocumentVerification;
use App\Support\Navigation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminModerationController extends Controller
{
    public function index(): View
    {
        $documents = DocumentVerification::query()
            ->with('user')
            ->latest()
            ->paginate(15);

        $stats = [
            ['label' => __('common.pending'), 'value' => DocumentVerification::where('status', 'pending')->count()],
            ['label' => __('common.approved'), 'value' => DocumentVerification::where('status', 'approved')->count()],
            ['label' => __('common.rejected'), 'value' => DocumentVerification::where('status', 'rejected')->count()],
        ];

        return view('admin.moderation', [
            'documents' => $documents,
            'stats' => $stats,
            'navItems' => Navigation::adminItems('moderation'),
            'navActive' => 'moderation',
            'pageTitle' => __('nav.admin.suppliers_validation'),
            'pageSubtitle' => __('roles.moderation_subtitle'),
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
                'account_status' => \App\Models\User::STATUS_ACTIVE,
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

        return back()->with('success', __('roles.supplier_rejected'));
    }
}
