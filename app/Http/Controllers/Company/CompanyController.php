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
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'register_certificate.*' => 'required|file',
            'commercial_certificate.*' => 'required|file',
            'licenses.*' => 'file',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'register_num' => 'required|string',
        ]);

        $hashedPassword = bcrypt($request->password);

        // Create a new Company instance
        $company = new Company();

        // Save Multiple Register Certificates
        $registerCertificates = [];
        if ($request->hasFile('register_certificate')) {
            foreach ($request->file('register_certificate') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('register_certificate'), $fileName);
                $registerCertificates[] = $fileName;
            }
            $company->register_certificate = json_encode($registerCertificates);
        }

        // Save Multiple Commercial Certificates
        $commercialCertificates = [];
        if ($request->hasFile('commercial_certificate')) {
            foreach ($request->file('commercial_certificate') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('commercial_certificate'), $fileName);
                $commercialCertificates[] = $fileName;
            }
            $company->commercial_certificate = json_encode($commercialCertificates);
        }

        // Save Multiple Licenses
        $licenses = [];
        if ($request->hasFile('licenses')) {
            foreach ($request->file('licenses') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('licenses'), $fileName);
                $licenses[] = $fileName;
            }
            $company->licenses = json_encode($licenses);
        }

        // Save other company details
        $company->name = $request->name;
        $company->register_num = $request->register_num;
        $company->phone = $request->phone;
        $company->address = $request->address ?? null;
        $company->email = $request->email;
        $company->password = $hashedPassword;
        $company->save(); // Save company to generate its ID

        // Create associated User
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $hashedPassword;
        $user->role = 2; // Assign role for company
        $user->company_id = $company->id;
        $user->save();

        // Update company with user_id
        $company->user_id = $user->id;
        $company->save();

        // Log in the user
        auth()->login($user);

        // Redirect to dashboard
        return redirect()->route('company.company.dashboard')->with('message', 'Registration successful!');
    }

}
