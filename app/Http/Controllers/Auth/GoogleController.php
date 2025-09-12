<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Email tidak dikenali → login ditolak
                return redirect()->route('login')->withErrors([
                    'msg' => 'Login gagal: email tidak dikenali.'
                ]);
            }

            Auth::login($user);

            // Redirect sesuai role
            switch (strtolower($user->role)) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'staff':
                    return redirect()->route('staff.dashboard');
                case 'tenant':
                    return redirect()->route('tenant.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'msg' => 'Login gagal: role tidak dikenali.'
                    ]);
            }

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'msg' => 'Login gagal, coba lagi.'
            ]);
        }
    }
}
