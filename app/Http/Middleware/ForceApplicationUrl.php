<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceApplicationUrl
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! app()->environment(['local', 'testing'])) {
            return $next($request);
        }

        $appUrl = config('app.url');
        if (! is_string($appUrl) || $appUrl === '') {
            return $next($request);
        }

        $parts = parse_url($appUrl);
        if ($parts === false || ! isset($parts['host'])) {
            return $next($request);
        }

        $expectedHost = $parts['host'];
        $expectedScheme = $parts['scheme'] ?? 'http';
        $expectedPort = (int) ($parts['port'] ?? ($expectedScheme === 'https' ? 443 : 80));
        $actualPort = (int) $request->getPort();

        $hostMatches = $request->getHost() === $expectedHost;
        $portMatches = $actualPort === $expectedPort;
        $schemeMatches = $request->getScheme() === $expectedScheme;

        if ($hostMatches && $portMatches && $schemeMatches) {
            return $next($request);
        }

        return redirect()->to(rtrim($appUrl, '/').$request->getRequestUri());
    }
}
