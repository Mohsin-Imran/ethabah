<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function index()
    {
        $investors = User::where('role',0)->get();
        return view('admin.investor.index', get_defined_vars());
    }

    public function destroy($id)
    {
        $investor = User::find($id);
        $investor->delete();
        return back()->with('message', 'Data Delete SuccessFully');
    }

    public function view($id)
    {
        $investor = User::find($id);
        return view('admin.investor.view', get_defined_vars());
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2,3',
        ]);
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();
        return redirect()->back()->with('message', 'Status updated successfully.');
    }
}
