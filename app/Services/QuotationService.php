<?php

namespace App\Services;

use App\Models\Offre;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class QuotationService
{
    public function acceptOffer(Offre $offre, User $client): Order
    {
        $offre->load('demande');

        if ((int) $offre->demande?->user_id !== (int) $client->id) {
            throw new InvalidArgumentException(__('marketplace.offer_not_yours'));
        }

        if ($offre->status !== 'pending') {
            throw new InvalidArgumentException(__('marketplace.offer_not_pending'));
        }

        return DB::transaction(function () use ($offre, $client) {
            $offre->update(['status' => 'accepted']);

            Offre::query()
                ->where('demande_id', $offre->demande_id)
                ->where('id', '!=', $offre->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);

            $offre->demande?->update(['status' => 'completed']);

            return Order::create([
                'user_id' => $client->id,
                'supplier_id' => $offre->user_id,
                'demande_id' => $offre->demande_id,
                'offre_id' => $offre->id,
                'reference' => 'ORD-'.str_pad((string) (Order::max('id') + 1), 6, '0', STR_PAD_LEFT),
                'product_name' => $offre->title,
                'quantity' => 1,
                'unit_price' => $offre->price,
                'total_price' => $offre->price,
                'status' => 'confirmed',
                'ordered_at' => now(),
            ]);
        });
    }

    public function rejectOffer(Offre $offre, User $client): void
    {
        $offre->load('demande');

        if ((int) $offre->demande?->user_id !== (int) $client->id) {
            throw new InvalidArgumentException(__('marketplace.offer_not_yours'));
        }

        if ($offre->status !== 'pending') {
            throw new InvalidArgumentException(__('marketplace.offer_not_pending'));
        }

        $offre->update(['status' => 'rejected']);
    }
}
