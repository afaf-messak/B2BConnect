<?php

namespace App\Models;

use App\Services\ProductImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'stock',
        'moq',
        'unit',
        'is_active',
        'image',
        'fournisseur_id',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock' => 'integer',
            'moq' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function fournisseur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fournisseur_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->fournisseur();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function imageUrl(): ?string
    {
        $curatedImage = ProductImageService::forProductName($this->name);

        if ($curatedImage) {
            return $curatedImage;
        }

        if (! $this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        return Storage::disk('public')->url($this->image);
    }

    public function localizedName(): string
    {
        return self::localizedProductField($this->name, 'name') ?? $this->name;
    }

    public function localizedDescription(): ?string
    {
        return self::localizedProductField($this->name, 'description') ?? $this->description;
    }

    public function localizedCategory(): ?string
    {
        return self::localizedCategoryName($this->category);
    }

    public static function localizedCategoryName(?string $category): ?string
    {
        if (! $category) {
            return $category;
        }

        $key = 'product_catalog.categories.'.Str::slug($category);
        $translated = __($key);

        return $translated === $key ? $category : $translated;
    }

    /**
     * @return list<string>
     */
    public static function matchingLocalizedProductNames(string $search): array
    {
        $needle = self::normalizeSearch($search);

        if ($needle === '') {
            return [];
        }

        $items = __('product_catalog.items');

        if (! is_array($items)) {
            return [];
        }

        $matches = [];

        foreach ($items as $item) {
            if (! is_array($item) || empty($item['source'])) {
                continue;
            }

            $haystack = self::normalizeSearch(implode(' ', array_filter([
                $item['name'] ?? null,
                $item['description'] ?? null,
                $item['category'] ?? null,
            ])));

            if (str_contains($haystack, $needle)) {
                $matches[] = $item['source'];
            }
        }

        return array_values(array_unique($matches));
    }

    /**
     * @return list<string>
     */
    public static function matchingLocalizedCategories(string $search): array
    {
        $needle = self::normalizeSearch($search);

        if ($needle === '') {
            return [];
        }

        $categories = __('product_catalog.categories');

        if (! is_array($categories)) {
            return [];
        }

        $matches = [];

        foreach ($categories as $slug => $label) {
            if (! is_string($label) || ! str_contains(self::normalizeSearch($label), $needle)) {
                continue;
            }

            $matches[] = Str::of($slug)->replace('-', ' ')->title()->toString();
        }

        return array_values(array_unique($matches));
    }

    private static function localizedProductField(string $name, string $field): ?string
    {
        $key = 'product_catalog.items.'.Str::slug($name).'.'.$field;
        $translated = __($key);

        return $translated === $key ? null : $translated;
    }

    private static function normalizeSearch(string $value): string
    {
        return mb_strtolower(trim($value));
    }
}
