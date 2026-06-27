<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetLocale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LocaleController extends Controller
{
    public function switch(Request $request, string $locale): RedirectResponse
    {
        abort_unless(in_array($locale, SetLocale::LOCALES, true), 404);

        $request->session()->put('locale', $locale);

        Cookie::queue('locale', $locale, 60 * 24 * 365);

        return redirect()->back();
    }
}
