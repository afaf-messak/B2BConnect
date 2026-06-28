<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class SupplierProfile extends Model
{
    protected $fillable = [
        'user_id',
        'slug',
        'tagline',
        'bio',
        'industry',
        'city',
        'region',
        'country',
        'website',
        'phone',
        'services',
        'certifications',
        'portfolio',
        'response_time_hours',
        'is_public',
    ];

    protected function casts(): array
    {
        return [
            'services' => 'array',
            'certifications' => 'array',
            'portfolio' => 'array',
            'is_public' => 'boolean',
            'response_time_hours' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(SupplierReview::class, 'supplier_id', 'user_id');
    }

    public static function ensureFor(User $user): self
    {
        $base = Str::slug($user->company_name ?: $user->name ?: 'supplier');
        $slug = $base.'-'.$user->id;

        return static::firstOrCreate(
            ['user_id' => $user->id],
            ['slug' => $slug, 'country' => 'Morocco']
        );
    }

    public function averageRating(): ?float
    {
        $avg = SupplierReview::query()
            ->where('supplier_id', $this->user_id)
            ->avg('rating');

        return $avg !== null ? round((float) $avg, 1) : null;
    }

    public function reviewsCount(): int
    {
        return SupplierReview::query()
            ->where('supplier_id', $this->user_id)
            ->count();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
