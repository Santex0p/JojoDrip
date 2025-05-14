<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function login(Request $request): RedirectResponse
    {
       $credentials = $request->validate([
           'user' => ['required'],
           'password' => ['required'],
        ]);

       if(Auth::attempt($credentials)) {
           $request->session()->regenerate();
           return redirect()->route('home');
       }
       return back()->withErrors([
           'user' => 'The provided credentials do not match our records.',
       ])->onlyInput('user');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        return redirect()->intended('home');
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'user' => ['required'],
            'password' => ['required'],
        ]);

        $existingUser = Admin::query()->where('user', $credentials['user'])->select('user')->first()->toArray();

        if($existingUser) {
            Admin::query()->update([
                'password' => Hash::make($credentials['password']),
            ]);
        }


        return redirect()->intended('/');
    }
}
