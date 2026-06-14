<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\User;
use App\Support\Navigation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminDemandeController extends Controller
{
    public function index(Request $request): View
    {
        $query = Demande::query()->with('user')->latest();

        if ($search = $request->string('q')->trim()->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($status = $request->string('status')->toString()) {
            $query->where('status', $status);
        }

        $demandes = $query->paginate(15)->withQueryString();

        return view('admin.demandes.index', [
            'demandes' => $demandes,
            'filters' => $request->only(['q', 'status']),
            'navItems' => Navigation::adminItems('demandes'),
            'navActive' => 'demandes',
            'pageTitle' => __('nav.admin.demandes'),
            'pageSubtitle' => __('admin.demandes_subtitle'),
            'stats' => [
                ['label' => __('admin.stats.total_demandes'), 'value' => Demande::count()],
                ['label' => __('common.pending'), 'value' => Demande::where('status', 'pending')->count()],
                ['label' => __('common.completed'), 'value' => Demande::where('status', 'completed')->count()],
            ],
        ]);
    }

    public function create(): View
    {
        return view('admin.demandes.form', [
            'demande' => new Demande(['status' => 'pending', 'quantity' => 1]),
            'clients' => $this->clients(),
            'navItems' => Navigation::adminItems('demandes'),
            'navActive' => 'demandes',
            'pageTitle' => __('admin.create_demande'),
            'pageSubtitle' => __('admin.create_demande_subtitle'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $demande = Demande::create($this->validatedDemande($request));

        return redirect()
            ->route('admin.demandes.show', $demande)
            ->with('success', __('admin.demande_created'));
    }

    public function show(Demande $demande): View
    {
        $demande->load(['user', 'offres.user', 'orders']);

        return view('admin.demandes.show', [
            'demande' => $demande,
            'navItems' => Navigation::adminItems('demandes'),
            'navActive' => 'demandes',
            'pageTitle' => $demande->title,
            'pageSubtitle' => __('admin.demande_details'),
        ]);
    }

    public function edit(Demande $demande): View
    {
        return view('admin.demandes.form', [
            'demande' => $demande,
            'clients' => $this->clients(),
            'navItems' => Navigation::adminItems('demandes'),
            'navActive' => 'demandes',
            'pageTitle' => __('admin.edit_demande'),
            'pageSubtitle' => $demande->title,
        ]);
    }

    public function update(Request $request, Demande $demande): RedirectResponse
    {
        $demande->update($this->validatedDemande($request));

        return redirect()
            ->route('admin.demandes.show', $demande)
            ->with('success', __('admin.demande_updated'));
    }

    public function destroy(Demande $demande): RedirectResponse
    {
        $demande->delete();

        return redirect()->route('admin.demandes.index')->with('success', __('admin.demande_deleted'));
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedDemande(Request $request): array
    {
        return $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected', 'completed'])],
            'needed_at' => ['nullable', 'date'],
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, User>
     */
    private function clients()
    {
        return User::query()
            ->where('role', User::ROLE_CLIENT)
            ->orderBy('name')
            ->get(['id', 'name', 'email']);
    }
}
