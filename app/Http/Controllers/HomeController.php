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
            if (auth()->check() && auth()->user()->role == 1) {
                return redirect()->route('admin.admin.dashboard');
            } elseif (auth()->check() && auth()->user()->role == 2) {
                return redirect()->route('company.company.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
