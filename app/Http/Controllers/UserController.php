<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Derm;
use App\Models\Inquiry;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Retrieve only the logged-in user's inquiries from the 'inquiries' table
        $inquiries = Inquiry::where('email', $user->email)
            ->paginate(8);

        return view('user.dashboard', compact('inquiries'));
    }

    public function dashboardSearch(Request $request)
    {
        $searchTerm = $request->input('query');

        // Search and paginate results
        $inquiries = Inquiry::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('inquiry', 'LIKE', "%{$searchTerm}%")
                ->orWhere('payment_method', 'LIKE', "%{$searchTerm}%");
        })
            ->paginate(5); // Adjust pagination size here as well

        // Return only the table content to be replaced via AJAX
        return view('user.tables.dashboard_table', compact('inquiries'))->render();
    }

    public function dashboardResponse($id)
    {
        $inquiry = Inquiry::findOrFail($id); // Fetch the inquiry details by ID
        return view('user.dashboardResponse', compact('inquiry'));
    }

    // Payment Controller
    public function gcash($id)
    {
        // Redirect to GCash payment page
        return redirect()->away('https://gcash-payment-gateway-url?inquiry_id='.$id);
    }

    public function maya($id)
    {
        // Redirect to Maya payment page
        return redirect()->away('https://maya-payment-gateway-url?inquiry_id='.$id);
    }

    public function paypal($id)
    {
        // Redirect to PayPal payment page
        return redirect()->away('https://paypal-payment-gateway-url?inquiry_id='.$id);
    }


    // Inquire Controller

    public function inquire()
    {
        $staffs = User::where('role', 'Staff')->get();
        return view('user.inquire', compact('staffs'));
    }

    public function inquireAdd()
    {
        return view('user.inquireAdd');
    }

    public function inquireStore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'inquiry' => 'required|string',
        ]);

        // Get the currently logged-in user
        $user = Auth::user();

        // Create a new inquiry record
        Inquiry::create([
            'patient_name' => $request->input('patient_name'),
            'username' => $user->username,
            'email' => $user->email,
            'contact_number' => $user->contact_number,
            'date' => Carbon::now(), // Set the current date
            'inquiry' => $request->input('inquiry'),
            'payment_method' => $request->input('payment_method'), // Optional field
        ]);

        // Redirect or return a response after saving the inquiry
        return redirect()->route('user.dashboard')->with('success', 'Inquiry submitted successfully!');
    }

    // NumberInquiries Controller

    public function numberInquiries()
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Retrieve only the logged-in user's inquiries from the 'inquiries' table
        $inquiries = Inquiry::where('email', $user->email)
            ->paginate(7);

        return view('user.numberInquiries', compact('inquiries'));
    }

    public function numberInquiriesSearch(Request $request)
    {
        $searchTerm = $request->input('query');

        // Search and paginate results
        $inquiries = Inquiry::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('inquiry', 'LIKE', "%{$searchTerm}%")
                ->orWhere('patient_name', 'LIKE', "%{$searchTerm}%");
        })
            ->paginate(5); // Adjust pagination size here as well

        // Return only the table content to be replaced via AJAX
        return view('user.tables.numberInquiries_table', compact('inquiries'))->render();
    }

    public function numberInquiriesHistory($id)
    {
        $inquiry = Inquiry::findOrFail($id); // Fetch the inquiry details by ID
        return view('user.numberInquiriesHistory', compact('inquiry'));
    }
}
