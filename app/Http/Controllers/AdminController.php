<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function accounts()
    {
        return view('admin.accounts');
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
