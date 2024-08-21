<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Derm;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function patientRecord()
    {
        $staffs = User::where('role', 'Staff')->get();
        $users = User::where('role', 'User')->get();
        return view('staff.patientRecord', compact('staffs', 'users'));
    }

    // Scan Controller
    public function scan()
    {
        $derms = Derm::all();
        return view('staff.scan', compact('derms'));
    }

    // Inquiry Controller
    public function inquiry()
    {
        $users = User::where('role', 'User')->get();
        return view('staff.inquiry', compact('users'));
    }
}
