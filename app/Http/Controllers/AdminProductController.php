<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\Navigation;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->with('fournisseur')
            ->latest()
            ->paginate(20);

        return view('admin.products.index', [
            'products' => $products,
            'navItems' => Navigation::adminItems('products'),
            'navActive' => 'products',
            'pageTitle' => __('nav.admin.products'),
            'pageSubtitle' => __('products.admin_subtitle'),
        ]);
    }
}
