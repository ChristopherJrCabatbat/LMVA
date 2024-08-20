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

    public function numberInquiries()
    {
        $staffs = User::where('role', 'Staff')->get();
        return view('user.numberInquiries', compact('staffs'));
    }
}
