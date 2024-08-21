<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Derm;

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
        $staffs = User::where('role', 'Staff')->get();
        $users = User::where('role', 'User')->get();
        return view('admin.dashboard', compact('staffs', 'users'));
    }

    public function dashboardAdd()
    {
        return view('admin.dashboardAdd');
    }



    // Accounts Controller
    public function accounts()
    {
        $staffs = User::where('role', 'Staff')->get();
        $users = User::where('role', 'User')->get();

        // $users = User::all();
        return view('admin.accounts', compact('staffs', 'users'));
    }

    public function accountsAddStaff()
    {
        return view('admin.accountsAddStaff');
    }

    public function accountsAddStaffStore(Request $request): RedirectResponse
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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

        return redirect()->route('admin.accounts')->with('success', 'Account added successfully!');
    }

    public function accountsAddUser()
    {
        return view('admin.accountsAddUser');
    }

    public function accountsAddUserStore(Request $request): RedirectResponse
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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




    // DERM Controller
    public function derm()
    {
        $derms = Derm::all();

        // Passing the derm records to the view
        return view('admin.derm', compact('derms'));
    }

    public function dermAdd()
    {
        return view('admin.dermAdd');
    }

    public function dermStore(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'derm' => 'required|string|max:255',
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

    // Report Controllers
    public function reports()
    {
        $users = User::where('role', 'User')->get();
        return view('admin.reports', compact('users'));
    }
}
