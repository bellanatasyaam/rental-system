<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil user yang login
        $user = Auth::user();

        // Kalau Admin arahkan ke dashboard admin
        if ($user->hasRole('admin')) {
            return redirect('/');
        }

        // Kalau Staff arahkan ke dashboard staff
        if ($user->hasRole('staff')) {
            return view('dashboard.staff', compact('user'));    
        }

        // Default fallback
        return view('dashboard.default', compact('user'));
    }
}
