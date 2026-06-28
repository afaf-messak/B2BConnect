<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public const ROLE_ADMIN = 'admin';

    public const ROLE_CLIENT = 'client';

    public const ROLE_SUPPLIER = 'supplier';

    public const STATUS_ACTIVE = 'active';

    public const STATUS_PENDING = 'pending';

    public const STATUS_SUSPENDED = 'suspended';

    public const STATUS_REJECTED = 'rejected';

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'company_name',
        'ice',
        'role',
        'account_status',
        'onboarding_completed',
        'password',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'onboarding_completed' => 'boolean',
        ];
    }

    public function demandes(): HasMany
    {
        return $this->hasMany(Demande::class);
    }

    public function offres(): HasMany
    {
        return $this->hasMany(Offre::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function documentVerifications(): HasMany
    {
        return $this->hasMany(DocumentVerification::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'fournisseur_id');
    }

    public function socialAccounts(): HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function supplierProfile(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SupplierProfile::class);
    }

    public function supplierReviewsReceived(): HasMany
    {
        return $this->hasMany(SupplierReview::class, 'supplier_id');
    }

    public function favoriteSuppliers(): HasMany
    {
        return $this->hasMany(FavoriteSupplier::class, 'client_id');
    }

    public function supplierOrders(): HasMany
    {
        return $this->hasMany(Order::class, 'supplier_id');
    }

    public function isVerifiedSupplier(): bool
    {
        return $this->isSupplier()
            && $this->account_status === self::STATUS_ACTIVE
            && $this->isOnboarded();
    }

    public function isSupplier(): bool
    {
        return $this->role === self::ROLE_SUPPLIER;
    }

    public function isClient(): bool
    {
        return $this->role === self::ROLE_CLIENT;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isOnboarded(): bool
    {
        return (bool) $this->onboarding_completed;
    }

    public function needsSupplierApproval(): bool
    {
        return $this->isSupplier() && $this->account_status === self::STATUS_PENDING;
    }

    public function isAccountActive(): bool
    {
        return $this->account_status === self::STATUS_ACTIVE;
    }

    public function isSuspended(): bool
    {
        return $this->account_status === self::STATUS_SUSPENDED;
    }

    public function isRejected(): bool
    {
        return $this->account_status === self::STATUS_REJECTED;
    }

    public function supplierStatusLabel(): string
    {
        if (! $this->isSupplier()) {
            return $this->account_status ?? self::STATUS_ACTIVE;
        }

        return match ($this->account_status) {
            self::STATUS_ACTIVE => 'approved',
            self::STATUS_PENDING => 'pending',
            self::STATUS_REJECTED => 'rejected',
            self::STATUS_SUSPENDED => 'suspended',
            default => $this->account_status ?? 'pending',
        };
    }

    public function dashboardRoute(): string
    {
        return \App\Support\RoleRedirect::routeFor($this);
    }

    public function unreadMessagesCount(): int
    {
        return $this->receivedMessages()->whereNull('read_at')->count();
    }

    public function avatarUrl(): ?string
    {
        return $this->avatar;
    }
}
