<?php

namespace App\Http\Controllers;

use App\Support\RoleRedirect;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        return redirect()->route(RoleRedirect::routeFor(auth()->user()));
    }
}
