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
    <div class="mb-8 grid gap-6 xl:grid-cols-[minmax(0,1fr)_28rem]">
        <article class="saas-card min-h-[24rem]">
            <div class="flex items-center justify-between gap-4">
                <h3 class="text-lg font-bold">{{ __('nav.my_requests') }}</h3>
                <button type="button" id="refresh-demandes" class="saas-btn-secondary saas-btn-icon" title="Actualiser" aria-label="Actualiser">
                    <span class="material-symbols-outlined text-[18px]">refresh</span>
                </button>
            </div>
            <div id="demandes-list" class="mt-5 space-y-3">
                <p class="text-sm text-on-surface-variant">{{ __('common.loading') }}</p>
            </div>
        </article>
        <article id="new-demande-card" class="saas-card">
            <h3 class="text-lg font-bold">{{ __('common.new_request') }}</h3>
            <p id="demande-form-message" class="mt-3 hidden rounded-xl px-4 py-3 text-sm font-medium"></p>
            <form id="demande-form" class="mt-5 space-y-5" novalidate>
                <div class="saas-form-group">
                    <label for="demande-title" class="saas-label">{{ __('demandes.title') }}</label>
                    <input id="demande-title" type="text" name="title" required maxlength="255" autocomplete="off" placeholder="Ex: Logiciel Informatique" class="saas-input h-12 rounded-xl">
                    <p class="saas-field-error hidden" data-error-for="title"></p>
                </div>
                <div class="saas-form-group">
                    <label for="demande-description" class="saas-label">{{ __('demandes.description') }}</label>
                    <textarea id="demande-description" name="description" rows="4" required placeholder="Decrivez votre besoin, les fonctionnalites et le delai souhaite..." class="saas-input min-h-[7rem] rounded-xl"></textarea>
                    <p class="saas-field-error hidden" data-error-for="description"></p>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="saas-form-group">
                        <label for="demande-budget" class="saas-label">{{ __('demandes.budget') }}</label>
                        <div class="relative">
                            <input id="demande-budget" type="number" step="0.01" min="0" inputmode="decimal" name="budget" placeholder="2000" class="saas-input h-12 rounded-xl pe-14">
                            <span class="pointer-events-none absolute inset-y-0 end-4 flex items-center text-sm font-semibold text-on-surface-variant">{{ __('common.currency') }}</span>
                        </div>
                        <p class="saas-field-error hidden" data-error-for="budget"></p>
                    </div>
                    <div class="saas-form-group">
                        <label for="demande-category" class="saas-label">{{ __('demandes.category') }}</label>
                        <input id="demande-category" type="text" name="category" maxlength="255" list="demande-categories" placeholder="Logiciel" class="saas-input h-12 rounded-xl">
                        <datalist id="demande-categories">
                            <option value="Logiciel"></option>
                            <option value="Materiel informatique"></option>
                            <option value="Services"></option>
                            <option value="Logistique"></option>
                            <option value="Fournitures"></option>
                        </datalist>
                        <p class="saas-field-error hidden" data-error-for="category"></p>
                    </div>
                    <div class="saas-form-group">
                        <label for="demande-quantity" class="saas-label">{{ __('demandes.quantity') }}</label>
                        <input id="demande-quantity" type="number" min="1" step="1" name="quantity" value="1" required class="saas-input h-12 rounded-xl">
                        <p class="saas-field-error hidden" data-error-for="quantity"></p>
                    </div>
                    <div class="saas-form-group">
                        <label for="demande-needed-at" class="saas-label">{{ __('common.date') }}</label>
                        <input id="demande-needed-at" type="date" name="needed_at" class="saas-input h-12 rounded-xl">
                        <p class="saas-field-error hidden" data-error-for="needed_at"></p>
                    </div>
                </div>
                <button type="submit" id="submit-demande" class="saas-btn-primary h-12 w-full rounded-xl text-base">
                    <span class="material-symbols-outlined text-[20px]">add_circle</span>
                    <span data-submit-label>{{ __('common.create') }}</span>
                </button>
            </form>
        </article>
    </div>
@endsection

@push('scripts')
<script>
    const listEl = document.getElementById('demandes-list');
    const form = document.getElementById('demande-form');
    const formCard = document.getElementById('new-demande-card');
    const openButton = document.getElementById('open-demande-modal');
    const refreshButton = document.getElementById('refresh-demandes');
    const submitButton = document.getElementById('submit-demande');
    const formMessage = document.getElementById('demande-form-message');
    const submitLabel = submitButton?.querySelector('[data-submit-label]');
    const createLabel = @json(__('common.create'));
    const loadingLabel = @json(__('common.loading'));
    const successLabel = @json(__('demandes.created'));
    const noResultsLabel = @json(__('common.no_results'));
    const errorLabel = 'Une erreur est survenue.';

    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, (char) => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;',
        }[char]));
    }

    function setMessage(type, message) {
        if (!formMessage) return;
        formMessage.className = 'mt-3 rounded-xl px-4 py-3 text-sm font-medium';
        formMessage.classList.add(type === 'error' ? 'bg-red-50' : 'bg-green-50', type === 'error' ? 'text-error' : 'text-green-700');
        formMessage.textContent = message;
        formMessage.classList.toggle('hidden', !message);
    }

    function clearErrors() {
        form?.querySelectorAll('.saas-input-error').forEach((field) => field.classList.remove('saas-input-error'));
        form?.querySelectorAll('[data-error-for]').forEach((error) => {
            error.textContent = '';
            error.classList.add('hidden');
        });
        setMessage('success', '');
    }

    function showErrors(errors) {
        Object.entries(errors || {}).forEach(([field, messages]) => {
            const input = form?.querySelector(`[name="${field}"]`);
            const error = form?.querySelector(`[data-error-for="${field}"]`);
            input?.classList.add('saas-input-error');
            if (error) {
                error.textContent = Array.isArray(messages) ? messages[0] : messages;
                error.classList.remove('hidden');
            }
        });
    }

    async function loadDemandes() {
        try {
            listEl.innerHTML = '<p class="text-sm text-on-surface-variant">' + loadingLabel + '</p>';
            const res = await fetch('{{ route('client.demandes.index') }}', { headers: { 'Accept': 'application/json' } });
            if (!res.ok) throw new Error();
            const data = await res.json();
            const items = data.data || data;
            if (!items.length) {
                listEl.innerHTML = '<p class="text-sm text-on-surface-variant">' + noResultsLabel + '</p>';
                return;
            }
            listEl.innerHTML = items.map(d => `
                <a href="{{ url('/client/demandes') }}/${d.id}" class="group flex items-start justify-between gap-4 rounded-xl border border-outline-variant/40 bg-surface-container-low px-4 py-3 transition hover:-translate-y-0.5 hover:border-secondary-container/60 hover:bg-surface-container hover:shadow-card">
                    <span>
                        <span class="block font-semibold text-on-surface">${escapeHtml(d.title)}</span>
                        <span class="mt-1 block text-xs text-on-surface-variant">${escapeHtml(d.category || '')}</span>
                    </span>
                    <span class="rounded-full bg-secondary-container/30 px-2.5 py-1 text-xs font-semibold text-primary">${escapeHtml(d.status)}</span>
                </a>
            `).join('');
        } catch {
            listEl.innerHTML = '<p class="text-sm text-on-surface-variant">' + noResultsLabel + '</p>';
        }
    }

    openButton?.addEventListener('click', () => {
        formCard?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        setTimeout(() => document.getElementById('demande-title')?.focus(), 350);
    });

    refreshButton?.addEventListener('click', loadDemandes);

    form?.addEventListener('submit', async (e) => {
        e.preventDefault();
        clearErrors();
        submitButton.disabled = true;
        if (submitLabel) submitLabel.textContent = loadingLabel;

        const fd = new FormData(form);
        const payload = Object.fromEntries(fd.entries());
        try {
            const response = await fetch('{{ route('client.demandes.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify(payload),
            });
            const data = await response.json().catch(() => ({}));

            if (!response.ok) {
                showErrors(data.errors);
                setMessage('error', data.message || errorLabel);
                return;
            }

            form.reset();
            document.getElementById('demande-quantity').value = 1;
            setMessage('success', successLabel);
            loadDemandes();
        } finally {
            submitButton.disabled = false;
            if (submitLabel) submitLabel.textContent = createLabel;
        }
    });

    loadDemandes();
</script>
@endpush
