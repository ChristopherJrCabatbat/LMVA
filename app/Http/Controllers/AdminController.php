<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function accounts()
    {
        $staffs = User::where('role', 'Staff')->get();
        $users = User::where('role', 'User')->get();

        // $users = User::all();
        return view('admin.accounts', compact('staffs', 'users'));
    }
    public function derm()
    {
        return view('admin.derm');
    }
    public function reports()
    {
        return view('admin.reports');
    }
}
