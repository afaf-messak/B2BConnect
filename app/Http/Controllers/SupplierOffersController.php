<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Support\Navigation;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\View\View;

class SupplierOffersController extends Controller
{
    public function index(Request $request): View
    {
        $supplier = $request->user();

        $offersQuery = Offre::query()
            ->with(['demande.user'])
            ->where('user_id', $supplier->id)
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->when($request->filled('q'), function ($q) use ($request) {
                $search = $request->string('q')->toString();
                $q->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhereHas('demande', fn ($q) => $q->where('title', 'like', "%{$search}%"));
                });
            })
            ->latest();

        $stats = [
            'total' => Offre::where('user_id', $supplier->id)->count(),
            'pending' => Offre::where('user_id', $supplier->id)->where('status', 'pending')->count(),
            'accepted' => Offre::where('user_id', $supplier->id)->where('status', 'accepted')->count(),
        ];

        return view('supplier.offers.index', [
            'offers' => $offersQuery->paginate(15)->withQueryString(),
            'stats' => $stats,
            'filters' => $request->only(['q', 'status']),
            'navItems' => Navigation::supplierItems('offers', $supplier),
        ]);
    }

    public function export(Request $request): StreamedResponse
    {
        $supplier = $request->user();

        $offers = Offre::query()
            ->with('demande')
            ->where('user_id', $supplier->id)
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%'.$search.'%')
                        ->orWhereHas('demande', fn ($query) => $query->where('title', 'like', '%'.$search.'%'));
                });
            })
            ->latest()
            ->get();

        return response()->streamDownload(function () use ($offers) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Title', 'Request', 'Price', 'Delivery days', 'Status', 'Date']);

            foreach ($offers as $offre) {
                fputcsv($handle, [
                    $offre->id,
                    $offre->title,
                    $offre->demande?->title,
                    $offre->price,
                    $offre->delivery_time_days,
                    $offre->status,
                    $offre->created_at?->format('Y-m-d H:i'),
                ]);
            }

            fclose($handle);
        }, 'supplier-offers.csv', ['Content-Type' => 'text/csv']);
    }
}
