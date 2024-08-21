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
        return view('staff.scan');
    }

    // Inquiry Controller
    public function inquiry()
    {
        $staffs = User::where('role', 'Staff')->get();
        return view('staff.inquiry', compact('staffs'));
    }
}
