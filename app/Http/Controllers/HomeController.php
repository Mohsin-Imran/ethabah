<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            logger('Authenticated user:', ['user' => $user]);
            if ($user->role == 1) {
                return redirect()->route('admin.admin.dashboard');
            } elseif ($user->role == 2) {
                if ($user->status == 0) {
                    return 'dsadsad';
                } else {
                    return redirect()->route('company.company.dashboard');
                }
            } elseif ($user->role == 0) {
                return redirect()->route('investor.investor.dashboard');
            }
        }
        logger('User not authenticated');
        return redirect()->route('login');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
