<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SeoRouteRestriction
{
    /**
     * SEO staff can create/update but never delete.
     * Page access is controlled by CheckPermission + user permissions.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user || !$user->isSeo()) {
            return $next($request);
        }

        $routeName = $request->route()?->getName() ?? '';

        $deniedSuffixes = ['.destroy', '.restore', '.forceDelete'];
        foreach ($deniedSuffixes as $suffix) {
            if (str_ends_with($routeName, $suffix)) {
                abort(403, 'SEO staff cannot delete records.');
            }
        }

        return $next($request);
    }
}
