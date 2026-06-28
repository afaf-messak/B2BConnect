<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Services\QuotationService;
use App\Support\Navigation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientOfferController extends Controller
{
    public function __construct(
        private readonly QuotationService $quotations
    ) {}

    public function index(Request $request): View
    {
        $user = $request->user();

        $offersQuery = Offre::query()
            ->with(['user.supplierProfile', 'demande'])
            ->whereHas('demande', fn ($q) => $q->where('user_id', $user->id))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->when($request->filled('q'), function ($q) use ($request) {
                $search = $request->string('q')->toString();
                $q->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhereHas('user', fn ($q) => $q->where('company_name', 'like', "%{$search}%"));
                });
            })
            ->latest();

        $stats = [
            'total' => (clone $offersQuery)->count(),
            'pending' => Offre::whereHas('demande', fn ($q) => $q->where('user_id', $user->id))->where('status', 'pending')->count(),
            'accepted' => Offre::whereHas('demande', fn ($q) => $q->where('user_id', $user->id))->where('status', 'accepted')->count(),
        ];

        return view('client.offers.index', [
            'offers' => $offersQuery->paginate(15)->withQueryString(),
            'stats' => $stats,
            'filters' => $request->only(['q', 'status']),
            'navItems' => Navigation::clientItems('offers', $user),
            'navActive' => 'offers',
            'pageTitle' => __('nav.offers_received'),
        ]);
    }

    public function accept(Request $request, Offre $offre): RedirectResponse
    {
        try {
            $this->quotations->acceptOffer($offre, $request->user());
        } catch (\InvalidArgumentException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()
            ->route('client.orders.index')
            ->with('success', __('marketplace.offer_accepted'));
    }

    public function reject(Request $request, Offre $offre): RedirectResponse
    {
        try {
            $this->quotations->rejectOffer($offre, $request->user());
        } catch (\InvalidArgumentException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', __('marketplace.offer_rejected'));
    }
}
