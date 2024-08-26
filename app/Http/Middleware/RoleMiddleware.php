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

        // Define the allowed route names for each role
        $allowedRoutes = [
            'Admin' => [
                'admin.dashboard',
                'admin.dashboardAdd',
                'admin.dashboardStore',

                'admin.accounts',
                'admin.accountsAddStaff',
                'admin.accountsAddStaffStore',
                'admin.accountsAddUser',
                'admin.accountsAddUserStore',

                'admin.derm',
                'admin.dermAdd',
                'admin.dermStore',
                'admin.dermShow',

                'admin.reports',
            ],
            'Staff' => [
                'staff.patientRecord',
                'staff.patientRecordCategorize',

                'staff.derm',
                'staff.dermShow',

                'staff.inquiry',
                'staff.inquiryRespond',
                'staff.inquiryRespondStore',
            ],
            'User'  => [
                'user.dashboard',
                'user.dashboardResponse',

                'user.inquire',
                'user.inquireAdd',
                'user.inquireStore',
                
                'user.numberInquiries',
            ],
        ];

        // Check if the current route name is in the allowed routes for the user's role
        if (!in_array($request->route()->getName(), $allowedRoutes[$role] ?? [])) {
            $message = "You can only access {$role}'s files. Please log out first to continue.";
            session()->flash('error', $message);

            // Redirect to the first allowed route (dashboard)
            return back();
        }

        return $next($request);
    }
}