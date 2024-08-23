<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Derm;
use App\Models\Record;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function patientRecord()
    {
        // $records = Record::all();
        $records = Record::paginate(3);
        return view('staff.patientRecord', compact('records'));
    }

    // Scan Controller
    public function scan()
    {
        // $derms = Derm::all();
        $derms = Derm::paginate(3);
        return view('staff.scan', compact('derms'));
    }

    // Inquiry Controller
    public function inquiry()
    {
        // $users = User::where('role', 'User')->get();
        $users = User::where('role', 'User')->paginate(5);
        return view('staff.inquiry', compact('users'));
    }
}
