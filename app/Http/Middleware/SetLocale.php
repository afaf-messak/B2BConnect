<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /** @var list<string> */
    public const LOCALES = ['fr', 'en', 'ar'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale')
            ?? $request->cookie('locale')
            ?? config('app.locale');

        if (in_array($locale, self::LOCALES, true)) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
