<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Offre;
use App\Models\Order;
use App\Support\Navigation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierDemandeController extends Controller
{
    public function index(Request $request): View
    {
        $demandes = Demande::query()
            ->with('user')
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);

        return view('supplier.demandes.index', [
            'demandes' => $demandes,
            'navItems' => Navigation::supplierItems('demandes', $request->user()),
            'navActive' => 'demandes',
            'pageTitle' => __('nav.demandes'),
            'pageSubtitle' => __('demandes.supplier_subtitle'),
        ]);
    }
}
