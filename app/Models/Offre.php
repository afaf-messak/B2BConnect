<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offre extends Model
{
    /** @use HasFactory<\Database\Factories\OffreFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'demande_id',
        'title',
        'description',
        'price',
        'delivery_time_days',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function demande(): BelongsTo
    {
        return $this->belongsTo(Demande::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
