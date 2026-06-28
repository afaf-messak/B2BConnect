<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = User::query()->where('role', 'supplier')->get();

        if ($suppliers->isEmpty()) {
            $suppliers = User::factory(3)->create(['role' => 'supplier']);
        }

        $catalogue = [
            [
                'name' => 'Dell Latitude 5440 i5 13e Gen',
                'category' => 'Informatique',
                'description' => 'PC portable professionnel 14 pouces, Intel Core i5, 16 Go RAM, SSD 512 Go. Ideal pour equipes commerciales et back-office.',
                'price' => 8790.00,
                'stock' => 36,
                'moq' => 2,
                'unit' => 'piece',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'HP LaserJet Pro M404dn',
                'category' => 'Bureautique',
                'description' => 'Imprimante laser monochrome reseau avec recto verso automatique, adaptee aux volumes de bureau quotidiens.',
                'price' => 2490.00,
                'stock' => 22,
                'moq' => 1,
                'unit' => 'piece',
                'image' => 'https://compuscience.com.eg/2523-medium_default/hp-laserjet-pro-m404dn.jpg',
            ],
            [
                'name' => 'Cisco Catalyst 2960X 24 ports',
                'category' => 'Reseau',
                'description' => 'Switch manageable 24 ports Gigabit pour PME, VLAN, QoS et administration securisee.',
                'price' => 6900.00,
                'stock' => 14,
                'moq' => 1,
                'unit' => 'piece',
                'image' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Carton double cannelure 60x40x40 cm',
                'category' => 'Emballage',
                'description' => 'Carton robuste pour expedition e-commerce, stockage et preparation logistique.',
                'price' => 8.90,
                'stock' => 5200,
                'moq' => 100,
                'unit' => 'carton',
                'image' => 'https://kartonske-kutije.rs/fajlovi/product/60x40x40-cm-kartonske-kutije-troslojne-large-545.jpg',
            ],
            [
                'name' => 'Film etirable transparent 23 microns',
                'category' => 'Emballage',
                'description' => 'Rouleau de film etirable manuel pour palettisation, maintien des charges et protection transport.',
                'price' => 42.00,
                'stock' => 860,
                'moq' => 12,
                'unit' => 'rouleau',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0a/Pallet_wrapper.jpg/250px-Pallet_wrapper.jpg',
            ],
            [
                'name' => 'Palette Europe EPAL 1200x800 mm',
                'category' => 'Logistique',
                'description' => 'Palette bois standard EPAL pour transport, entreposage et export.',
                'price' => 145.00,
                'stock' => 410,
                'moq' => 10,
                'unit' => 'palette',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3e/EPAL-Europalette.jpg/250px-EPAL-Europalette.jpg',
            ],
            [
                'name' => 'Gants nitrile non poudres boite de 100',
                'category' => 'EPI',
                'description' => 'Gants jetables nitrile pour industrie, laboratoire, maintenance et nettoyage professionnel.',
                'price' => 69.00,
                'stock' => 1250,
                'moq' => 20,
                'unit' => 'boite',
                'image' => 'https://images.unsplash.com/photo-1583947215259-38e31be8751f?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Casque de securite 3M SecureFit',
                'category' => 'EPI',
                'description' => 'Casque chantier reglable avec suspension confortable, conforme aux usages industriels.',
                'price' => 118.00,
                'stock' => 310,
                'moq' => 5,
                'unit' => 'piece',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/6/60/V-GardProtectiveCap.png',
            ],
            [
                'name' => 'Roulement SKF 6205-2RS1',
                'category' => 'Pieces industrielles',
                'description' => 'Roulement a billes etanche pour moteurs, convoyeurs et machines de production.',
                'price' => 54.00,
                'stock' => 640,
                'moq' => 10,
                'unit' => 'piece',
                'image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Courroie trapezoidale Gates B45',
                'category' => 'Pieces industrielles',
                'description' => 'Courroie de transmission industrielle pour maintenance preventive et remplacement machine.',
                'price' => 76.00,
                'stock' => 280,
                'moq' => 6,
                'unit' => 'piece',
                'image' => 'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Cable electrique cuivre 3G2.5 mm2',
                'category' => 'Electricite',
                'description' => 'Cable cuivre souple pour installations basse tension, vendu en couronne de 100 metres.',
                'price' => 890.00,
                'stock' => 96,
                'moq' => 1,
                'unit' => 'couronne',
                'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Projecteur LED industriel 150W IP65',
                'category' => 'Electricite',
                'description' => 'Eclairage LED haute puissance pour entrepots, ateliers et zones exterieures.',
                'price' => 420.00,
                'stock' => 155,
                'moq' => 4,
                'unit' => 'piece',
                'image' => 'https://images.unsplash.com/photo-1494438639946-1ebd1d20bf85?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Bobine papier thermique 80x80 mm',
                'category' => 'Consommables',
                'description' => 'Bobines pour caisse, terminal point de vente et imprimantes tickets.',
                'price' => 7.50,
                'stock' => 3400,
                'moq' => 50,
                'unit' => 'bobine',
                'image' => 'https://images.unsplash.com/photo-1607083206968-13611e3d76db?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Sac kraft brun 32x16x44 cm',
                'category' => 'Emballage',
                'description' => 'Sac kraft recyclable avec poignees torsadees pour retail, restauration et boutiques.',
                'price' => 1.95,
                'stock' => 9800,
                'moq' => 250,
                'unit' => 'sac',
                'image' => 'https://images.unsplash.com/photo-1604719312566-8912e9227c6a?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Distributeur savon automatique 1L',
                'category' => 'Hygiene',
                'description' => 'Distributeur mural sans contact pour sanitaires professionnels et espaces publics.',
                'price' => 185.00,
                'stock' => 180,
                'moq' => 3,
                'unit' => 'piece',
                'image' => 'https://images.unsplash.com/photo-1584464491033-06628f3a6b7b?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Rayonnage metallique charge lourde',
                'category' => 'Stockage',
                'description' => 'Etagere industrielle modulable 5 niveaux pour reserve, atelier et entrepot.',
                'price' => 1350.00,
                'stock' => 48,
                'moq' => 1,
                'unit' => 'module',
                'image' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=900&q=80',
            ],
        ];

        Product::query()->delete();

        foreach ($catalogue as $index => $product) {
            Product::query()->create($product + [
                'fournisseur_id' => $suppliers[$index % $suppliers->count()]->id,
                'is_active' => true,
            ]);
        }
    }
}
