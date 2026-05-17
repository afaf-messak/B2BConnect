<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    /** @use HasFactory<\Database\Factories\DemandeFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'quantity',
        'budget',
        'status',
        'needed_at',
    ];

    protected function casts(): array
    {
        return [
            'budget' => 'decimal:2',
            'needed_at' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function offres(): HasMany
    {
        return $this->hasMany(Offre::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
