<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function view()
    {
        $id = auth()->user()->id;
        $profile = User::with('company')->find(id: $id);
        return view('investor.profile.view', compact('profile'));
    }
    public function edit()
    {
        $id = auth()->user()->id;
        $profile = User::with('company')->find(id: $id);
        // dd($profile);
        return view('investor.profile.edit', compact('profile'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'national_id.*' => 'nullable|file',
            'passport.*' => 'nullable|file',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'address' => 'required|string',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $user = User::find(auth()->user()->id);

        // Update Multiple National ID Files (if new files are provided)
        if ($request->hasFile('national_id')) {
            $nationalIds = [];
            foreach ($request->file('national_id') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('investor_profile'), $fileName);
                $nationalIds[] = $fileName;
            }
            $user->national_id = json_encode($nationalIds);
        }

        // Update Multiple Passport Files (if new files are provided)
        if ($request->hasFile('passport')) {
            $passports = [];
            foreach ($request->file('passport') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('investor_profile'), $fileName);
                $passports[] = $fileName;
            }
            $user->passport = json_encode($passports);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        // Update Password (if provided)
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->back()->with('message', 'Data updated successfully');
    }

}
