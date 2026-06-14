<?php

namespace App\Http\Controllers;

use App\Models\DocumentVerification;
use App\Models\SupplierProfile;
use App\Models\User;
use App\Support\Navigation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query()->latest();

        if ($search = $request->string('q')->trim()->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        if ($role = $request->string('role')->toString()) {
            $query->where('role', $role);
        }

        if ($status = $request->string('status')->toString()) {
            $query->where('account_status', $status);
        }

        $users = $query->paginate(15)->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
            'filters' => $request->only(['q', 'role', 'status']),
            'navItems' => Navigation::adminItems('users'),
            'navActive' => 'users',
            'pageTitle' => __('nav.admin.users'),
            'pageSubtitle' => __('admin.users_subtitle'),
            'stats' => [
                ['label' => __('admin.stats.total_users'), 'value' => User::count()],
                ['label' => __('roles.client'), 'value' => User::where('role', User::ROLE_CLIENT)->count()],
                ['label' => __('roles.supplier'), 'value' => User::where('role', User::ROLE_SUPPLIER)->count()],
            ],
        ]);
    }

    public function create(Request $request): View
    {
        return view('admin.users.create', [
            'user' => new User(['role' => $request->string('role')->toString() ?: User::ROLE_CLIENT]),
            'navItems' => Navigation::adminItems('users'),
            'navActive' => 'users',
            'pageTitle' => __('admin.create_user'),
            'pageSubtitle' => __('admin.create_user_subtitle'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateUser($request);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company_name' => $validated['company_name'] ?? null,
            'ice' => $validated['ice'] ?? null,
            'role' => $validated['role'],
            'account_status' => $validated['account_status'],
            'password' => Hash::make($validated['password']),
            'onboarding_completed' => true,
        ]);

        $user->forceFill(['email_verified_at' => now()])->save();

        $this->afterUserSaved($user, $validated['account_status']);

        return redirect()
            ->route('admin.users.show', $user)
            ->with('success', __('admin.user_created'));
    }

    public function show(User $user): View
    {
        $user->loadCount(['demandes', 'offres', 'orders', 'products', 'sentMessages', 'receivedMessages']);
        $user->load(['demandes' => fn ($q) => $q->latest()->limit(5), 'products' => fn ($q) => $q->latest()->limit(5), 'offres' => fn ($q) => $q->latest()->limit(5)]);

        return view('admin.users.show', [
            'user' => $user,
            'navItems' => Navigation::adminItems('users'),
            'navActive' => 'users',
            'pageTitle' => $user->name,
            'pageSubtitle' => __('admin.user_details'),
        ]);
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user,
            'navItems' => Navigation::adminItems('users'),
            'navActive' => 'users',
            'pageTitle' => __('admin.edit_user'),
            'pageSubtitle' => $user->email,
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $this->validateUser($request, $user);

        if ($user->isAdmin() && $validated['role'] !== User::ROLE_ADMIN) {
            $adminCount = User::where('role', User::ROLE_ADMIN)->where('id', '!=', $user->id)->count();
            if ($adminCount < 1) {
                return back()->with('error', __('admin.cannot_remove_last_admin'));
            }
        }

        if (! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        $this->afterUserSaved($user, $validated['account_status']);

        return redirect()->route('admin.users.show', $user)->with('success', __('admin.user_updated'));
    }

    public function suspend(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', __('admin.cannot_suspend_self'));
        }

        if ($user->isAdmin()) {
            return back()->with('error', __('admin.cannot_suspend_admin'));
        }

        $user->update(['account_status' => User::STATUS_SUSPENDED]);

        return back()->with('success', __('admin.user_suspended_success'));
    }

    public function activate(User $user): RedirectResponse
    {
        $user->update(['account_status' => User::STATUS_ACTIVE]);

        return back()->with('success', __('admin.user_activated'));
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', __('admin.cannot_delete_self'));
        }

        if ($user->isAdmin()) {
            $adminCount = User::where('role', User::ROLE_ADMIN)->where('id', '!=', $user->id)->count();
            if ($adminCount < 1) {
                return back()->with('error', __('admin.cannot_remove_last_admin'));
            }
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', __('admin.user_deleted'));
    }

    /**
     * @return array<string, mixed>
     */
    private function validateUser(Request $request, ?User $user = null): array
    {
        $passwordRules = $user
            ? ['nullable', 'confirmed', Password::defaults()]
            : ['required', 'confirmed', Password::defaults()];

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user?->id)],
            'password' => $passwordRules,
            'company_name' => ['nullable', 'string', 'max:255'],
            'ice' => ['nullable', 'string', 'max:50'],
            'role' => ['required', Rule::in([User::ROLE_ADMIN, User::ROLE_CLIENT, User::ROLE_SUPPLIER])],
            'account_status' => ['required', Rule::in([
                User::STATUS_ACTIVE,
                User::STATUS_PENDING,
                User::STATUS_SUSPENDED,
                User::STATUS_REJECTED,
            ])],
        ]);
    }

    private function afterUserSaved(User $user, string $accountStatus): void
    {
        if ($user->isSupplier()) {
            SupplierProfile::ensureFor($user);

            if ($accountStatus === User::STATUS_ACTIVE) {
                DocumentVerification::query()->updateOrCreate(
                    ['user_id' => $user->id, 'document_type' => 'ice'],
                    [
                        'status' => 'approved',
                        'reviewer_id' => auth()->id(),
                        'verified_at' => now(),
                        'rejection_reason' => null,
                    ]
                );
            }
        }
    }
}
