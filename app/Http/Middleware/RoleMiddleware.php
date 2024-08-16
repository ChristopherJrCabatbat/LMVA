<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Define the allowed routes for each role
        $allowedRoutes = [
            'Admin' => ['admin/dashboard'],
            'Staff' => ['staff/dashboard'],
            'User' => [
                'user/dashboard',
                'user/inquire',
            ],
            // Add other user routes here
        ];

        $role = $user->role;

        // If the current path is not in the allowed routes for the role, redirect to the role's dashboard
        if (!in_array($request->path(), $allowedRoutes[$role] ?? [])) {
            return redirect($allowedRoutes[$role][0]); // Redirect to the first allowed route (dashboard)
        }

        return $next($request);
    }


    // public function handle(Request $request, Closure $next): Response
    // {
    //     $user = Auth::user();
    //     $role = $user->role;

    //     // Define the dashboard routes and allowed routes for each role
    //     $roleRoutes = [
    //         'Admin' => [
    //             'dashboard' => 'admin/dashboard',
    //             'allowed' => ['admin/*'],
    //         ],
    //         'Staff' => [
    //             'dashboard' => 'staff/dashboard',
    //             'allowed' => ['staff/*'],
    //         ],
    //         'User' => [
    //             'dashboard' => 'user/dashboard',
    //             'allowed' => ['user/*'],
    //         ],
    //     ];

    //     // Get the routes for the user's role
    //     $routes = $roleRoutes[$role] ?? null;

    //     // Redirect to the dashboard if the user is logging in or accessing the root path
    //     if ($request->path() === 'login' || $request->path() === '/') {
    //         return redirect($routes['dashboard']);
    //     }

    //     // Check if the current path is allowed for the user's role
    //     $allowed = false;
    //     foreach ($routes['allowed'] as $allowedRoute) {
    //         if ($request->is($allowedRoute)) {
    //             $allowed = true;
    //             break;
    //         }
    //     }

    //     // If the route is not allowed, redirect to the user's dashboard
    //     if (!$allowed) {
    //         return redirect($routes['dashboard'])->with('error', 'You do not have access to that page.');
    //     }

    //     return $next($request);
    // }
}
