<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'register_num' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'register_certificate' => 'required',
            'commercial_certificate' => 'required',
            'licenses' => 'required',
            'password' => 'required|string|min:8',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $company = new Company;

        if ($request->hasFile('register_certificate') && $request->file('register_certificate')->isValid()) {
            $imageName = time() . '.' . $request->file('register_certificate')->getClientOriginalExtension();
            $request->file('register_certificate')->move(public_path('register_certificate'), name: $imageName);
            $company->register_certificate = $imageName;
        } else {
            return redirect()->back()->with('error', 'Image is required.');
        }

        if ($request->hasFile('commercial_certificate') && $request->file('commercial_certificate')->isValid()) {
            $imageName = time() . '.' . $request->file('commercial_certificate')->getClientOriginalExtension();
            $request->file('commercial_certificate')->move(public_path('commercial_certificate'), name: $imageName);
            $company->commercial_certificate = $imageName;
        } else {
            return redirect()->back()->with('error', 'Image is required.');
        }
        if ($request->hasFile('licenses') && $request->file('licenses')->isValid()) {
            $imageName = time() . '.' . $request->file('licenses')->getClientOriginalExtension();
            $request->file('licenses')->move(public_path('licenses'), name: $imageName);
            $company->licenses = $imageName;
        } else {
            return redirect()->back()->with('error', 'Image is required.');
        }

        $company->user_id = $user->id;
        $company->name = $request->name;
        $company->register_num = $request->register_num;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->password = bcrypt($request->password);
        $company->register_certificate = $imageName;
        $company->save();
        return response()->json(['message' => 'Data saved successfully!', 'data' => $company], 201);
    }

}
