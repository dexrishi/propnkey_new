<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventSeoDelete
{
    /**
     * Block delete/restore actions for SEO staff.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user || !$user->isSeo()) {
            return $next($request);
        }

        if ($request->isMethod('DELETE')) {
            abort(403, 'SEO staff cannot delete records.');
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
