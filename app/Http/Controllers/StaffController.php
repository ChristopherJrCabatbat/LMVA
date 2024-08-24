<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Derm;
use App\Models\Record;
use App\Models\Inquiry;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function patientRecord()
    {
        // Retrieve all available derms
        $derms = Derm::all();

        // Retrieve records with a null category
        $records = Record::whereNull('category')->paginate(3);

        return view('staff.patientRecord', compact('records', 'derms'));
    }

    public function patientRecordCategorize(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'category' => 'required|string|max:255',
            'record_id' => 'required|exists:records,id',
        ]);

        // Find the record by ID and update the category
        $record = Record::find($request->input('record_id'));
        $record->category = $request->input('category');
        $record->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Record categorized successfully!');
    }

    // Scan Controller
    public function scan()
    {
        // $derms = Derm::all();
        $derms = Derm::paginate(3);
        return view('staff.scan', compact('derms'));
    }

    public function scanShow($derm)
    {
        // Find the DERM by name
        $dermRecord = Derm::where('derm', $derm)->firstOrFail();

        // Retrieve all records associated with this DERM
        $records = Record::where('category', $derm)->get();

        return view('staff.scanShow', compact('dermRecord', 'records'));
    }

    // Inquiry Controller
    public function inquiry()
    {
        // $users = User::where('role', 'User')->get();
        // $users = User::where('role', 'User')->paginate(5);
        $inquiries = Inquiry::paginate(5);

        return view('staff.inquiry', compact('inquiries'));
    }
}
