<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Derm;
use App\Models\Record;
use App\Models\Inquiry;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function patientRecord()
    {
        // Retrieve all available derms
        $derms = Derm::all();

        // Retrieve records with a null category
        $records = Record::whereNull('category')->paginate(4);

        return view('staff.patientRecord', compact('records', 'derms'));
    }

    public function patientRecordSearch(Request $request)
    {
        $searchTerm = $request->input('query');
        $derms = Derm::all();

        // Search and paginate results for records with null category
        $records = Record::whereNull('category')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where(function ($subQuery) use ($searchTerm) {
                    $subQuery->where('file_details', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('original_file_name', 'LIKE', "%{$searchTerm}%");
                });
            })
            ->paginate(5); // Adjust pagination size as needed

        // Return only the table content to be replaced via AJAX
        return view('staff.tables.patientRecord_table', compact('records', 'derms'))->render();
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

    public function scanSearch(Request $request)
    {
        $searchTerm = $request->input('query');

        // Search and paginate results
        $derms = Derm::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('derm', 'LIKE', "%{$searchTerm}%");
        })
            ->paginate(3); // Adjust pagination size here as well

        // Return only the table content to be replaced via AJAX
        return view('staff.tables.scan_table', compact('derms'))->render();
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
        // $inquiries = Inquiry::paginate(5);
        $inquiries = Inquiry::whereNull('response')->paginate(5);

        return view('staff.inquiry', compact('inquiries'));
    }

    public function inquirySearch(Request $request)
    {
        $searchTerm = $request->input('query');

        // Search and paginate results for inquiries with null category
        $inquiries = Inquiry::whereNull('response')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where(function ($subQuery) use ($searchTerm) {
                    $subQuery->where('email', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('contact_number', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('inquiry', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('payment_method', 'LIKE', "%{$searchTerm}%")
                        ;
                });
            })
            ->paginate(5); // Adjust pagination size as needed

        // Return only the table content to be replaced via AJAX
        return view('staff.tables.inquiry_table', compact('inquiries'))->render();
    }

    public function inquiryRespond($id)
    {
        $inquiry = Inquiry::findOrFail($id); // Fetch the inquiry details by ID
        return view('staff.inquiryRespond', compact('inquiry'));
    }

    public function inquiryRespondStore(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'response' => 'required|string|max:5000', // Ensure response is provided and is within character limit
            'response_file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048', // Validate the uploaded file
        ]);

        // Find the inquiry by ID and update the response field
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->response = $request->input('response');

        // Save the username of the currently logged-in staff in the 'staff' field
        $inquiry->staff = Auth::user()->username;

        // Handle file upload
        if ($request->hasFile('response_file')) {
            $file = $request->file('response_file');
            $originalFileName = $file->getClientOriginalName(); // Get the original file name

            // Store the file in the public storage under 'inquiry_responses'
            $filePath = $file->store('inquiry_responses', 'public');

            // Store the file path and original file name in the database
            $inquiry->response_file = $filePath;
            $inquiry->original_file_name = $originalFileName; // Save the original file name
        }

        // Save the updated inquiry record to the database
        $inquiry->save();

        // Redirect back with a success message
        return redirect()->route('staff.inquiry')->with('success', 'Response submitted successfully!');
    }
}
