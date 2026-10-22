<?php

namespace App\Http\Middleware;

use App\Support\AdminPermissions;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Ensure the authenticated user may access the current admin route.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Super admin bypasses all permission checks
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        $routeName = $request->route()?->getName() ?? '';

        if (in_array($routeName, AdminPermissions::alwaysAllowedRoutes(), true)) {
            return $next($request);
        }

        // Dashboard is available to every authenticated admin user
        if ($routeName === 'dashboard') {
            return $next($request);
        }

        $permission = AdminPermissions::permissionForRoute($routeName);

        // Unknown / unmapped routes: allow only if user somehow reaches them
        // Prefer deny for safety on admin group
        if ($permission === null) {
            // dashboard etc. already mapped; unmapped named routes deny
            if ($routeName !== '') {
                abort(403, 'Unauthorized. You do not have permission to access this page.');
            }
            return $next($request);
        }

        // Super-admin-only modules
        if (array_key_exists($permission, AdminPermissions::superAdminOnly())) {
            abort(403, 'Unauthorized. Super Admin access required.');
        }

        if (!$user->hasPermission($permission)) {
            abort(403, 'Unauthorized. You do not have permission to access this page.');
        }

        return $next($request);
    }
}
