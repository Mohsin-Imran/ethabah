<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
        $id = auth()->user()->id;
        $settings = User::find($id);
        return view('admin.setting.index', compact('settings')); // Pass $setting to the view
    }
    public function edit()
    {
        $id = auth()->user()->id;
        $setting = User::find($id);
        return view('admin.setting.edit', compact('setting')); // Pass $setting to the view
    }

    public function update(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:settings,email,' . auth()->user()->id,
            'phone' => 'required|string|max:15',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $setting = User::find(auth()->user()->id);
        $setting->name = $request->name;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        if ($request->password) {
            $setting->password = bcrypt($request->password);
        }
        $setting->save();
        return redirect()->back()->with('success', 'Setting Updated');
    }

}