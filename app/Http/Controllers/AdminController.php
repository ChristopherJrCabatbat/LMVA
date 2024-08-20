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


    // DERM Controller
    public function derm()
    {
        $staffs = User::where('role', 'Staff')->get();
        $users = User::where('role', 'User')->get();

        return view('admin.derm', compact('staffs', 'users'));
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
        $staffs = User::where('role', 'Staff')->get();
        return view('admin.reports', compact('staffs'));
    }
}
