<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $role = $user->role;

        // Define the allowed routes for each role
        $allowedRoutes = [
            'Admin' => [
                'admin/dashboard',
                'admin/accounts',
                'admin/derm',
                'admin/reports',
            ],
            'Staff' => [
                'staff/patientRecord',
                'staff/scan',
                'staff/inquiry',
            ],
            'User'  => [
                'user/dashboard', 
                'user/inquire',
                'user/numberInquiries',
            ], // Add other user routes here
        ];

        // If the current path is not in the allowed routes for the role, flash a simplified error message
        if (!in_array($request->path(), $allowedRoutes[$role] ?? [])) {
            $message = "You can only access {$role}'s files. Please log out first to continue.";
            session()->flash('error', $message);

            // Redirect to the first allowed route (dashboard)
            // return redirect($allowedRoutes[$role][0]);
            return back();
        }

        return $next($request);
    }
}

