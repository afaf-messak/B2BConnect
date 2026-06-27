<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Support\Navigation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientDemandeViewController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return app(DemandeController::class)->index($request);
        }

        return view('client.demande.index', [
            'navItems' => Navigation::clientItems('demandes', $request->user()),
            'navActive' => 'demandes',
            'pageTitle' => __('nav.my_requests'),
        ]);
    }

    public function show(Request $request, Demande $demande): View
    {
        abort_unless((int) $demande->user_id === (int) $request->user()->id, 403);

        return view('client.demande.show', [
            'demande' => $demande->load(['user', 'orders', 'offres.user', 'messages']),
            'navItems' => Navigation::clientItems('demandes', $request->user()),
            'navActive' => 'demandes',
            'pageTitle' => $demande->title,
        ]);
    }
}
