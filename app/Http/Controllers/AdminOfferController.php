<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Support\Navigation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminOfferController extends Controller
{
    public function index(Request $request): View
    {
        $query = Offre::query()->with(['user', 'demande'])->latest();

        if ($search = $request->string('q')->trim()->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        if ($status = $request->string('status')->toString()) {
            $query->where('status', $status);
        }

        $offers = $query->paginate(15)->withQueryString();

        return view('admin.offers.index', [
            'offers' => $offers,
            'filters' => $request->only(['q', 'status']),
            'navItems' => Navigation::adminItems('offers'),
            'navActive' => 'offers',
            'pageTitle' => __('nav.admin.offers'),
            'pageSubtitle' => __('admin.offers_subtitle'),
            'stats' => [
                ['label' => __('admin.stats.total_offres'), 'value' => Offre::count()],
                ['label' => __('common.pending'), 'value' => Offre::where('status', 'pending')->count()],
                ['label' => __('marketplace.accepted_offers'), 'value' => Offre::where('status', 'accepted')->count()],
            ],
        ]);
    }

    public function show(Offre $offre): View
    {
        $offre->load(['user', 'demande.user']);

        return view('admin.offers.show', [
            'offre' => $offre,
            'navItems' => Navigation::adminItems('offers'),
            'navActive' => 'offers',
            'pageTitle' => $offre->title,
            'pageSubtitle' => __('admin.offer_details'),
        ]);
    }

    public function destroy(Offre $offre): RedirectResponse
    {
        $offre->delete();

        return redirect()->route('admin.offers.index')->with('success', __('admin.offer_deleted'));
    }
}
