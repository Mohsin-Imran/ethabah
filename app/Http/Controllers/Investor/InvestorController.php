<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class InvestorController extends Controller
{

    public function index()
    {
        return view('investor.register');
    }

    public function investorRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'passport.*' => 'required|file',
            'national_id.*' => 'required|file',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'address' => 'required|string|min:8',
        ]);

        $hashedPassword = bcrypt($request->password);
        $user = new User();
        $registerCertificates = [];
        if ($request->hasFile('national_id')) {
            foreach ($request->file('national_id') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('investor_register'), name: $fileName);
                $registerCertificates[] = $fileName;
            }
            $user->national_id = json_encode($registerCertificates);
        }

        // Save Multiple Commercial Certificates
        $commercialCertificates = [];
        if ($request->hasFile('passport')) {
            foreach ($request->file('passport') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('investor_register'), $fileName);
                $commercialCertificates[] = $fileName;
            }
            $user->passport = json_encode($commercialCertificates);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address ?? null;
        $user->password = $hashedPassword;
        $user->role = 0;
        $user->save();
        auth()->login($user);
        return redirect()->route('investor.investor.dashboard')->with('message', 'Registration successful!');
    }

}
