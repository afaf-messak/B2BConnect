@extends('layouts.saas', [
    'title' => __('nav.my_requests') . ' - ' . __('common.app_name'),
    'pageTitle' => __('nav.my_requests'),
    'navActive' => 'demandes',
])

@section('header-actions')
    <button type="button" id="open-demande-modal" class="saas-btn-primary">
        <span class="material-symbols-outlined">add</span>
        {{ __('common.new_request') }}
    </button>
@endsection

@section('content')
    <div class="mb-8 grid gap-6 lg:grid-cols-3">
        <article class="saas-card lg:col-span-2">
            <h3 class="text-lg font-bold">{{ __('nav.my_requests') }}</h3>
            <div id="demandes-list" class="mt-4 space-y-3">
                <p class="text-sm text-on-surface-variant">{{ __('common.loading') }}</p>
            </div>
        </article>
        <article class="saas-card">
            <h3 class="text-lg font-bold">{{ __('common.new_request') }}</h3>
            <form id="demande-form" class="mt-4 space-y-4">
                <div class="saas-form-group">
                    <label class="saas-label">{{ __('demandes.title') }}</label>
                    <input type="text" name="title" required class="saas-input">
                </div>
                <div class="saas-form-group">
                    <label class="saas-label">{{ __('demandes.description') }}</label>
                    <textarea name="description" rows="3" required class="saas-input"></textarea>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="saas-form-group">
                        <label class="saas-label">{{ __('demandes.budget') }}</label>
                        <input type="number" step="0.01" name="budget" class="saas-input">
                    </div>
                    <div class="saas-form-group">
                        <label class="saas-label">{{ __('demandes.category') }}</label>
                        <input type="text" name="category" class="saas-input">
                    </div>
                </div>
                <button type="submit" class="saas-btn-primary w-full">{{ __('common.create') }}</button>
            </form>
        </article>
    </div>
@endsection

@push('scripts')
<script>
    const listEl = document.getElementById('demandes-list');
    const form = document.getElementById('demande-form');

    async function loadDemandes() {
        try {
            const res = await fetch('/client/demandes', { headers: { 'Accept': 'application/json' } });
            if (!res.ok) throw new Error();
            const data = await res.json();
            const items = data.data || data;
            if (!items.length) {
                listEl.innerHTML = '<p class="text-sm text-on-surface-variant">{{ __('common.no_results') }}</p>';
                return;
            }
            listEl.innerHTML = items.map(d => `
                <a href="/client/demandes/${d.id}" class="flex items-center justify-between rounded-xl bg-surface-container-low px-4 py-3 transition hover:bg-surface-container">
                    <span class="font-medium">${d.title}</span>
                    <span class="rounded-full bg-secondary-container/30 px-2 py-0.5 text-xs font-semibold text-primary">${d.status}</span>
                </a>
            `).join('');
        } catch {
            listEl.innerHTML = '<p class="text-sm text-on-surface-variant">{{ __('common.no_results') }}</p>';
        }
    }

    form?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const fd = new FormData(form);
        const payload = Object.fromEntries(fd.entries());
        const response = await fetch('{{ route('client.demandes.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify(payload),
        });
        if (response.ok) {
            form.reset();
            loadDemandes();
        }
    });

    loadDemandes();
</script>
@endpush
