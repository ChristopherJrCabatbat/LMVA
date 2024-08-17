<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function patientRecord()
    {
        return view('staff.patientRecord');
    }
    public function scan()
    {
        return view('staff.scan');
    }
    public function inquiry()
    {
        return view('staff.inquiry');
    }
}
