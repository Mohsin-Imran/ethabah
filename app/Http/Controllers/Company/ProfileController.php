<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function view()
    {
        $id = auth()->user()->id;
        $profile = User::with('company')->find(id: $id);
        return view('company.profile.view', compact('profile'));
    }
    public function edit()
    {
        $id = auth()->user()->id;
        $profile = User::with('company')->find(id: $id);
        // dd($profile);
        return view('company.profile.edit', compact('profile'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'register_certificate.*' => 'nullable|file',
            'commercial_certificate.*' => 'nullable|file',
            'licenses.*' => 'nullable|file',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'register_num' => 'required|string',
        ]);

        $user = auth()->user();
        $company = Company::where('user_id', $user->id)->firstOrFail();

        // Update Multiple Register Certificates (if new files are provided)
        if ($request->hasFile('register_certificate')) {
            $registerCertificates = [];
            foreach ($request->file('register_certificate') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('register_certificate'), $fileName);
                $registerCertificates[] = $fileName;
            }
            $company->register_certificate = json_encode($registerCertificates);
        }

        // Update Multiple Commercial Certificates (if new files are provided)
        if ($request->hasFile('commercial_certificate')) {
            $commercialCertificates = [];
            foreach ($request->file('commercial_certificate') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('commercial_certificate'), $fileName);
                $commercialCertificates[] = $fileName;
            }
            $company->commercial_certificate = json_encode($commercialCertificates);
        }

        // Update Multiple Licenses (if new files are provided)
        if ($request->hasFile('licenses')) {
            $licenses = [];
            foreach ($request->file('licenses') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('licenses'), $fileName);
                $licenses[] = $fileName;
            }
            $company->licenses = json_encode($licenses);
        }

        // Update company and user details
        $company->name = $request->name;
        $company->register_num = $request->register_num;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->save();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('message', 'Data updated successfully');
    }

}
