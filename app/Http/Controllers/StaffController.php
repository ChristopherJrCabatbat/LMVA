<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Derm;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function patientRecord()
    {
        return view('staff.patientRecord');
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
