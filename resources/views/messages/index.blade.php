@extends('layouts.saas', [
    'title' => __('messages.title') . ' - ' . __('common.app_name'),
    'pageTitle' => __('messages.title'),
    'pageSubtitle' => $portalRole === 'supplier' ? __('messages.subtitle_supplier') : __('messages.subtitle_client'),
    'navActive' => 'messages',
])

@section('header-actions')
    @if ($unreadTotal > 0)
        <span class="rounded-full bg-error px-3 py-1 text-xs font-bold text-white">{{ __('messages.unread', ['count' => $unreadTotal]) }}</span>
    @endif
@endsection

@section('content')
    <div class="flex flex-col gap-6 lg:h-[calc(100vh-12rem)] lg:flex-row">
        <aside class="flex max-h-72 flex-col overflow-hidden rounded-2xl border border-outline-variant/30 bg-surface-container-lowest shadow-card lg:max-h-none lg:w-80 lg:shrink-0">
            <div class="border-b border-outline-variant/20 px-4 py-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-on-surface-variant">{{ __('messages.conversations') }}</p>
            </div>
            <div class="custom-scrollbar flex-1 overflow-y-auto">
                @forelse ($conversations as $conversation)
                    @php
                        $partner = $conversation['partner'];
                        $latest = $conversation['latest'];
                        $isActive = $activePartner && $activePartner->id === $partner->id;
                    @endphp
                    <a href="{{ route('messages.show', $partner) }}" class="flex items-start gap-3 border-b border-outline-variant/10 px-4 py-3 transition hover:bg-surface-container-low {{ $isActive ? 'bg-secondary-container/30' : '' }}">
                        <div class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-primary text-sm font-bold text-on-primary">
                            {{ strtoupper(substr($partner->company_name ?: $partner->name, 0, 2)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between gap-2">
                                <p class="truncate text-sm font-semibold text-on-surface">{{ $partner->company_name ?: $partner->name }}</p>
                                <span class="shrink-0 text-[10px] text-on-surface-variant">{{ $latest->created_at->diffForHumans(null, true) }}</span>
                            </div>
                            <p class="truncate text-xs text-on-surface-variant">{{ Str::limit($latest->body, 48) }}</p>
                        </div>
                        @if ($conversation['unread'] > 0)
                            <span class="grid h-5 min-w-5 shrink-0 place-items-center rounded-full bg-primary px-1 text-[10px] font-bold text-on-primary">{{ $conversation['unread'] }}</span>
                        @endif
                    </a>
                @empty
                    <div class="p-6 text-center text-sm text-on-surface-variant">
                        <span class="material-symbols-outlined mb-2 block text-3xl text-outline">forum</span>
                        {{ __('messages.empty') }}
                        @if ($portalRole === 'client')
                            <a href="{{ route('marketplace.suppliers.index') }}" class="mt-2 block font-medium text-primary">{{ __('messages.browse_suppliers') }}</a>
                        @endif
                    </div>
                @endforelse
            </div>
        </aside>

        <section class="flex min-h-[420px] flex-1 flex-col overflow-hidden rounded-2xl border border-outline-variant/30 bg-surface-container-lowest shadow-card">
            @if ($activePartner)
                <div class="flex items-center gap-3 border-b border-outline-variant/20 px-5 py-4">
                    <div class="grid h-10 w-10 place-items-center rounded-full bg-primary text-sm font-bold text-on-primary">
                        {{ strtoupper(substr($activePartner->company_name ?: $activePartner->name, 0, 2)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-on-surface">{{ $activePartner->company_name ?: $activePartner->name }}</p>
                        <p class="text-xs text-on-surface-variant">{{ $activePartner->email }}</p>
                    </div>
                </div>

                @if ($productContext ?? null)
                    <div class="border-b border-outline-variant/20 bg-secondary-container/20 px-5 py-3 text-sm">
                        {{ __('messages.product_context') }}: <strong>{{ $productContext->name }}</strong>
                    </div>
                @endif

                <div id="chat-messages" class="custom-scrollbar flex-1 space-y-4 overflow-y-auto px-5 py-4" data-last-id="{{ $messages->last()?->id ?? 0 }}" data-poll-url="{{ route('messages.poll', $activePartner) }}">
                    @foreach ($messages as $message)
                        @php $isMine = $message->sender_id === auth()->id(); @endphp
                        <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}" data-message-id="{{ $message->id }}">
                            <div class="max-w-[75%] rounded-2xl px-4 py-2.5 text-sm shadow-sm {{ $isMine ? 'rounded-br-md bg-primary text-on-primary' : 'rounded-bl-md bg-surface-container text-on-surface' }}">
                                <p class="whitespace-pre-wrap">{{ $message->body }}</p>
                                @if ($message->attachment_path)
                                    <a href="{{ Storage::disk('public')->url($message->attachment_path) }}" target="_blank" rel="noopener" class="mt-2 inline-flex items-center gap-1 text-xs underline opacity-90">
                                        <span class="material-symbols-outlined text-sm">attach_file</span>
                                        {{ __('marketplace.attachment') }}
                                    </a>
                                @endif
                                <p class="mt-1 text-[10px] opacity-70">{{ $message->created_at->format('H:i') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <form method="POST" action="{{ route('messages.store', $activePartner) }}" enctype="multipart/form-data" class="border-t border-outline-variant/20 p-4">
                    @csrf
                    @if ($productContext ?? null)
                        <input type="hidden" name="product_id" value="{{ $productContext->id }}">
                    @endif
                    @error('body')<p class="mb-2 text-sm text-error">{{ $message }}</p>@enderror
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <input type="file" name="attachment" accept=".pdf,.doc,.docx,.xls,.xlsx,.png,.jpg,.jpeg,.webp,.zip" class="saas-input text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-secondary-container file:px-3 file:py-1.5 file:text-sm file:font-semibold">
                        <textarea name="body" rows="2" placeholder="{{ __('messages.placeholder') }}" class="saas-input flex-1 resize-none rounded-2xl">{{ old('body') }}</textarea>
                        <button type="submit" class="saas-btn-primary saas-btn-icon">
                            <span class="material-symbols-outlined">send</span>
                        </button>
                    </div>
                </form>
            @else
                <div class="flex flex-1 flex-col items-center justify-center p-8 text-center">
                    <span class="material-symbols-outlined mb-4 text-6xl text-outline">chat_bubble</span>
                    <h3 class="text-lg font-semibold text-on-surface">{{ __('messages.select') }}</h3>
                    <p class="mt-2 max-w-sm text-sm text-on-surface-variant">{{ __('messages.select_hint') }}</p>
                    @if ($portalRole === 'client')
                        <a href="{{ route('marketplace.suppliers.index') }}" class="saas-btn-primary mt-6">{{ __('messages.find_supplier') }}</a>
                    @endif
                </div>
            @endif
        </section>
    </div>
@endsection

@push('scripts')
    @if ($activePartner)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var container = document.getElementById('chat-messages');
                if (container) container.scrollTop = container.scrollHeight;

                var pollUrl = container?.dataset.pollUrl;
                var lastId = parseInt(container?.dataset.lastId || '0', 10);

                if (!pollUrl) return;

                setInterval(function () {
                    fetch(pollUrl + '?after=' + lastId, {
                        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                    })
                        .then(function (r) { return r.json(); })
                        .then(function (data) {
                            if (!data.messages || !data.messages.length) return;
                            data.messages.forEach(function (msg) {
                                if (document.querySelector('[data-message-id="' + msg.id + '"]')) return;
                                lastId = Math.max(lastId, msg.id);
                                container.dataset.lastId = String(lastId);
                                var wrap = document.createElement('div');
                                wrap.className = 'flex ' + (msg.mine ? 'justify-end' : 'justify-start');
                                wrap.dataset.messageId = msg.id;
                                var bubble = document.createElement('div');
                                bubble.className = 'max-w-[75%] rounded-2xl px-4 py-2.5 text-sm shadow-sm ' + (msg.mine ? 'rounded-br-md bg-primary text-on-primary' : 'rounded-bl-md bg-surface-container text-on-surface');
                                var body = document.createElement('p');
                                body.className = 'whitespace-pre-wrap';
                                body.textContent = msg.body;
                                bubble.appendChild(body);
                                if (msg.attachment_url) {
                                    var link = document.createElement('a');
                                    link.href = msg.attachment_url;
                                    link.target = '_blank';
                                    link.className = 'mt-2 block text-xs underline opacity-90';
                                    link.textContent = '{{ __('marketplace.attachment') }}';
                                    bubble.appendChild(link);
                                }
                                var time = document.createElement('p');
                                time.className = 'mt-1 text-[10px] opacity-70';
                                time.textContent = msg.time;
                                bubble.appendChild(time);
                                wrap.appendChild(bubble);
                                container.appendChild(wrap);
                            });
                            container.scrollTop = container.scrollHeight;
                        })
                        .catch(function () {});
                }, 4000);
            });
        </script>
    @endif
@endpush
