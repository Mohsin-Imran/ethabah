<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index()
    {
        return view('company.register');
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'register_certificate' => 'required',
            'commercial_certificate' => 'required',
            'licenses' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'register_num' => 'required|string',
        ]);

        $hashedPassword = bcrypt($request['password']);

        $company = new Company();
        if ($request->hasFile('register_certificate') && $request->file('register_certificate')->isValid()) {
            $registerCertName = time() . '.' . $request->register_certificate->extension();
            $request->register_certificate->move(public_path('register_certificate'), $registerCertName);
            $company->register_certificate = $registerCertName;
        }
        if ($request->hasFile('commercial_certificate') && $request->file('commercial_certificate')->isValid()) {
            $commercialCertName = time() . '.' . $request->commercial_certificate->extension();
            $request->commercial_certificate->move(public_path('commercial_certificate'), $commercialCertName);
            $company->commercial_certificate = $commercialCertName;
        }
        if ($request->hasFile('licenses') && $request->file('licenses')->isValid()) {
            $licensesName = time() . '.' . $request->licenses->extension();
            $request->licenses->move(public_path('licenses'), $licensesName);
            $company->licenses = $licensesName;
        }
        $company->name = $request['name'];
        $company->register_num = $request['register_num'];
        $company->phone = $request['phone'];
        $company->email = $request['email'];
        $company->password = $hashedPassword;

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = $hashedPassword;
        $user->role = 2;
        $user->save();

        $company->user_id = $user->id;
        $company->save();
        // return view('company.dashboard');
        return redirect()->route('company.company.dashboard')->with('message', 'Data updated successfully');
    }
}