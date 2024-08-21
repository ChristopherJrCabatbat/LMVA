<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Derm;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    // Inquire Controller

    public function inquire()
    {
        $staffs = User::where('role', 'Staff')->get();
        return view('user.inquire', compact('staffs'));
    }
    public function inquireAdd()
    {
        return view('user.inquireAdd');
    }

    // NumberInquiries Controller

    // public function numberInquiries()
    // {
    //     $users = User::where('role', 'User')->get();
    //     return view('user.numberInquiries', compact('users'));
    // }

    public function numberInquiries()
    {
        // Get the currently logged-in user's ID
        $userId = auth()->user()->id;

        // $userId = auth()->user();
        // dd($userId); // Debug the user object


        // Retrieve only the logged-in user's inquiries
        $users = User::where('role', 'User')
            ->where('id', $userId) // Filter by logged-in user ID
            ->get();

        return view('user.numberInquiries', compact('users'));
    }
}
