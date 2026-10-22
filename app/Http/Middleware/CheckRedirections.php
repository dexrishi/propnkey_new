<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Redirection;

class CheckRedirections
{
    /**
     * Handle an incoming request.
     * Check if there's a redirection for the current URL before routing
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip admin routes
        if ($request->is('admin/*') || $request->is('_debugbar/*') || $request->is('api/*')) {
            return $next($request);
        }

        // Get the current path
        $path = $request->path();
        
        // If path is empty, try root path
        if (empty($path)) {
            $path = '/';
        } else {
            // Ensure path starts with /
            $path = '/' . ltrim($path, '/');
        }

        // Check for redirection
        $redirection = Redirection::findRedirect($path);

        if ($redirection) {
            // Determine if to_url is absolute or relative
            $toUrl = $redirection->to_url;
            
            // If it's a full URL, redirect directly
            if (filter_var($toUrl, FILTER_VALIDATE_URL)) {
                return redirect($toUrl, (int)$redirection->type);
            }
            
            // If it's relative, ensure it starts with /
            if (!str_starts_with($toUrl, '/')) {
                $toUrl = '/' . $toUrl;
            }
            
            return redirect($toUrl, (int)$redirection->type);
        }

        return $next($request);
    }
}
