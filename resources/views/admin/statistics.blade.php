@extends('layouts.saas', ['navActive' => 'statistics'])

@section('content')
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($metrics as $metric)
            <article class="saas-card">
                <p class="text-xs font-semibold uppercase tracking-wide text-on-surface-variant">{{ $metric['label'] }}</p>
                <p class="mt-3 text-4xl font-bold text-primary">{{ $metric['value'] }}</p>
                @if (!empty($metric['breakdown']))
                    <dl class="mt-4 space-y-2 border-t border-outline-variant/20 pt-4 text-sm">
                        @foreach ($metric['breakdown'] as $key => $value)
                            <div class="flex justify-between">
                                <dt class="text-on-surface-variant">{{ $key }}</dt>
                                <dd class="font-semibold">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                @endif
            </article>
        @endforeach
    </div>
@endsection
