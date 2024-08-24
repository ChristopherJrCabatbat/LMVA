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
            ->paginate(3);

        return view('user.dashboard', compact('inquiries'));
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
        return redirect()->route('user.inquire')->with('success', 'Inquiry submitted successfully!');
    }

    // NumberInquiries Controller

    public function numberInquiries()
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Retrieve only the logged-in user's inquiries from the 'inquiries' table
        $inquiries = Inquiry::where('email', $user->email)
            ->paginate(3);

        return view('user.numberInquiries', compact('inquiries'));
    }
}
