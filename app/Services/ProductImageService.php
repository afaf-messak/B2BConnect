<?php

namespace App\Services;

use Illuminate\Support\Str;

class ProductImageService
{
    /**
     * Curated images for the demo catalogue products. These override generic
     * seed URLs so each card shows the product itself, not a loose category shot.
     */
    private const IMAGE_BY_PRODUCT = [
        'dell-latitude-5440-i5-13e-gen' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&w=900&q=80',
        'hp-laserjet-pro-m404dn' => 'https://compuscience.com.eg/2523-medium_default/hp-laserjet-pro-m404dn.jpg',
        'cisco-catalyst-2960x-24-ports' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=900&q=80',
        'carton-double-cannelure-60x40x40-cm' => 'https://kartonske-kutije.rs/fajlovi/product/60x40x40-cm-kartonske-kutije-troslojne-large-545.jpg',
        'film-etirable-transparent-23-microns' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0a/Pallet_wrapper.jpg/250px-Pallet_wrapper.jpg',
        'palette-europe-epal-1200x800-mm' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3e/EPAL-Europalette.jpg/250px-EPAL-Europalette.jpg',
        'gants-nitrile-non-poudres-boite-de-100' => 'https://images.unsplash.com/photo-1583947215259-38e31be8751f?auto=format&fit=crop&w=900&q=80',
        'casque-de-securite-3m-securefit' => 'https://upload.wikimedia.org/wikipedia/commons/6/60/V-GardProtectiveCap.png',
    ];

    public static function forProductName(?string $name): ?string
    {
        if (! $name) {
            return null;
        }

        return self::IMAGE_BY_PRODUCT[Str::slug($name)] ?? null;
    }
}
