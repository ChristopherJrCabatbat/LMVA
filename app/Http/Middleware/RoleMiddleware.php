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

        if ($user->role === 'Admin' && $request->path() !== 'admin/dashboard') {
            return redirect('admin/dashboard');
        }

        if ($user->role === 'Staff' && $request->path() !== 'staff/dashboard') {
            return redirect('staff/dashboard');
        }
       
        if ($user->role === 'User' && $request->path() !== 'user/dashboard') {
            return redirect('user/dashboard');
        }

        return $next($request);
    }
    
    // public function handle(Request $request, Closure $next, $role)
    // {
    //     // if (Auth::check() && Auth::user()->role === $role) {
    //     //     return $next($request);
    //     // }

    //     // return redirect('/')->with('error', 'You do not have access to this page.');

    //     if (Auth::user()->role === 'Admin') {
    //         return redirect('admin/dashboard');
    //     }

    //     elseif (Auth::user()->role === 'Staff') {
    //         return redirect('staff/dashboard');
    //     }

    //     return $next($request);
    // }
}
