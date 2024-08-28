<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Derm;
use App\Models\Record;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

use BaconQrCode\Writer\WriterException;
use BaconQrCode\Writer\QrCodeWriter;
use BaconQrCode\Renderer\Image\PngRenderer;
use BaconQrCode\Renderer\RendererInterface;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{

    // Dashboard Controllers
    public function dashboard()
    {
        // $records = Record::all();
        $records = Record::paginate(4);
        return view('admin.dashboard', compact('records'));
    }

    public function dashboardAdd()
    {
        return view('admin.dashboardAdd');
    }

    public function dashboardStore(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'file_details' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'category' => 'nullable|string|max:255',
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalFileName = $file->getClientOriginalName(); // Get the original file name

            // Store the file in the public storage
            $filePath = $file->store('records', 'public');

            // Save the record to the database
            Record::create([
                'file_details' => $request->input('file_details'),
                'file' => $filePath,
                'category' => $request->input('category'),
                'original_file_name' => $originalFileName, // Save the original file name
            ]);
        }

        // Redirect or return a response
        return redirect()->route('admin.dashboard')->with('success', 'Record added successfully!');
    }




    // Accounts Controller
    public function accounts(Request $request)
    {
        // Determine which table to show based on the query parameter
        $activeTable = $request->query('table', 'staff');

        // Paginate the results
        $staffs = User::where('role', 'Staff')->paginate(8);
        $users = User::where('role', 'User')->paginate(8);

        return view('admin.accounts', compact('staffs', 'users', 'activeTable'));
    }


    public function accountsAddStaff()
    {
        return view('admin.accountsAddStaff');
    }

    public function accountsAddStaffStore(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',
            ],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        $user = new User;
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->contact_number = $request->input('contact_number');
        $user->role = "Staff";
        $user->password = Hash::make($request->input('password'));

        $user->save();

        // event(new Registered($user));

        // Auth::login($user);

        return redirect()->route('admin.accounts')->with('success', 'Account created successfully!');
    }

    public function accountsAddUser()
    {
        return view('admin.accountsAddUser');
    }

    public function accountsAddUserStore(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',
            ],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        $user = new User;
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->contact_number = $request->input('contact_number');
        $user->role = "User";
        $user->password = Hash::make($request->input('password'));

        $user->save();

        // event(new Registered($user));

        // Auth::login($user);

        return redirect()->route('admin.accounts')->with('success', 'Account added successfully!');
        // return redirect('user/dashboard');
    }

    public function accountsUserShow($id)
    {
        // Fetch the staff member details
        $users = User::findOrFail($id);

        return view('admin.accountsUserShow', compact('users'));
    }
    public function accountsStaffShow($id)
    {
        // Fetch the staff member details
        $users = User::findOrFail($id);

        return view('admin.accountsStaffShow', compact('users'));
    }

    public function accountsEdit($id)
    {
        // Fetch the staff member details
        $users = User::findOrFail($id);

        return view('admin.accountsEdit', compact('users'));
    }

    public function accountsUpdate(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'password' => 'nullable|min:8|confirmed', // Add password validation
        ]);

        // Fetch the staff member
        $staff = User::findOrFail($id);

        // Update the staff member's details except password
        $staff->update($request->except('password', 'password_confirmation'));

        // Update the password if it was provided
        if ($request->filled('password')) {
            $staff->update([
                'password' => Hash::make($request->input('password')),
            ]);
        }

        return redirect()->route('admin.accounts')->with('success', 'Account updated successfully.');
    }


    public function accountDestroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Accont deleted successfully.');
    }




    // DERM Controller
    public function derm()
    {
        $derms = Derm::paginate(3);

        return view('admin.derm', compact('derms'));
    }

    public function dermAdd()
    {
        return view('admin.dermAdd');
    }

    public function dermStore(Request $request)
    {
        // Validate the incoming data with a uniqueness constraint
        $request->validate([
            'derm' => 'required|string|max:255|unique:derms,derm', // Ensure 'derm' is unique in the 'derms' table
        ], [
            'derm.unique' => "The derm '" . $request->input('derm') . "' has already been added.",
        ]);

        // Generate a random QR code
        $qrCode = new QrCode(uniqid()); // Generate a QR code with a unique ID
        $writer = new PngWriter();

        // Save the QR code image
        $qrCodePath = 'qr_codes/' . uniqid() . '.png';
        $filePath = public_path($qrCodePath);

        // Write the QR code to the file
        $result = $writer->write($qrCode)->getString();
        file_put_contents($filePath, $result);

        // Create a new Derm record
        Derm::create([
            'derm' => $request->input('derm'),
            'qr_code' => $qrCodePath, // Store the path to the QR code image
        ]);

        // Redirect or return a response
        return redirect()->route('admin.derm')->with('success', 'Derm added successfully!');
    }


    public function dermShow($derm)
    {
        // Find the DERM by name
        $dermRecord = Derm::where('derm', $derm)->firstOrFail();

        // Retrieve all records associated with this DERM
        $records = Record::where('category', $derm)->get();

        return view('admin.dermShow', compact('dermRecord', 'records'));
    }



    // Report Controllers
    public function reports()
    {
        // $users = User::where('role', 'User')->get();
        $users = User::where('role', 'User')->paginate(9);
        return view('admin.reports', compact('users'));
    }
}
