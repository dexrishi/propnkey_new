<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class RemoveIndexPhpFromUrls
{
    /**
     * Permanently redirect any /index.php URL to the clean path.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestUri = $request->getRequestUri();

        if (!preg_match('#(^|/)index\.php(/|\?|$)#i', $requestUri)) {
            return $next($request);
        }

        $parts = parse_url($requestUri);
        $path = $parts['path'] ?? '/';
        $cleanPath = preg_replace('#/index\.php#i', '', $path) ?? $path;
        $cleanPath = '/' . ltrim($cleanPath, '/');
        if ($cleanPath === '' || $cleanPath === '//') {
            $cleanPath = '/';
        }

        $query = isset($parts['query']) && $parts['query'] !== ''
            ? '?' . $parts['query']
            : '';

        // Relative 301 keeps the current host (avoids wrong APP_URL on redirects)
        return new RedirectResponse($cleanPath . $query, 301);
    }
}
