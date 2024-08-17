<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }
   
    public function inquire()
    {
        return view('user.inquire');
    }

    public function numberInquiries()
    {
        return view('user.numberInquiries');
    }
}
