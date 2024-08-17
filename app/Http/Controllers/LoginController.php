<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }

    public function staff()
    {
        return view('staff.dashboard');
    }

    public function user()
    {
        return view('user.dashboard');
    }

    public function inquire()
    {
        return view('user.inquire');
    }
}
