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
        'register_certificate.*' => 'required|file|mimes:jpg,png,pdf|max:2048',
        'commercial_certificate.*' => 'required|file|mimes:jpg,png,pdf|max:2048',
        'licenses.*' => 'file|mimes:jpg,png,pdf|max:2048',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'register_num' => 'required|string',
    ]);

    $hashedPassword = bcrypt($request->password);

    $company = new Company();

    // Save Multiple Register Certificates
    $registerCertificates = [];
    if ($request->hasFile('register_certificate')) {
        foreach ($request->file('register_certificate') as $file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->extension();
            $file->move(public_path('register_certificate'), $fileName);
            $registerCertificates[] = $fileName;
        }
        $company->register_certificate = json_encode($registerCertificates);
    }

    // Save Multiple Commercial Certificates
    $commercialCertificates = [];
    if ($request->hasFile('commercial_certificate')) {
        foreach ($request->file('commercial_certificate') as $file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->extension();
            $file->move(public_path('commercial_certificate'), $fileName);
            $commercialCertificates[] = $fileName;
        }
        $company->commercial_certificate = json_encode($commercialCertificates);
    }

    // Save Multiple Licenses
    $licenses = [];
    if ($request->hasFile('licenses')) {
        foreach ($request->file('licenses') as $file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->extension();
            $file->move(public_path('licenses'), $fileName);
            $licenses[] = $fileName;
        }
        $company->licenses = json_encode($licenses);
    }

    $company->name = $request->name;
    $company->register_num = $request->register_num;
    $company->phone = $request->phone;
    $company->email = $request->email;
    $company->password = $hashedPassword;

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $hashedPassword;
    $user->role = 2;
    $user->save();

    $company->user_id = $user->id;
    $company->save();
    auth()->login($user);
    return redirect()->route('company.company.dashboard')->with('message', 'Data updated successfully');
}

}