<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function login(Request $request): RedirectResponse
    {
       $credentials = $request->validate([
           'user' => 'required',
           'password' => 'required',
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
        return redirect()->route('home');
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'user' => 'required',
            'password' => 'required',
            'password-confirmation' => 'required|same:password',
        ]);

        $existingUser = null;

        // Take all users and check if input user existing
        $allUsers = Admin::all()->toArray();
        foreach ($allUsers as $user) {
            if ($user['user'] == $credentials['user']) {
                $existingUser = Admin::query()->where('user', $credentials['user'])->select('user')->first()->toArray();
            }
        }

        if($existingUser) {
            Admin::query()->update([
                'password' => Hash::make($credentials['password']),
            ]);
        }
        else
        {
            return redirect()->back()->withErrors(['user' => 'The provided credentials do not match our records.']);
        }


        return redirect()->intended('/');
    }
}
