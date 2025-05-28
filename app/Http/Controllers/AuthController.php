<?php
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : Controller for authentication actions (login, logout, resetPassword)
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

    /**
     * Handle user login.
     *
     * Validates credentials and attempts authentication.
     *
     * @param  Request          $request
     * @return RedirectResponse
     */
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

    /**
     * Log the user out.
     *
     * @param  Request          $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('home');
    }

    /**
     * Reset user password.
     *
     * Validates input, checks for existing admin user, and updates password.
     *
     * @param  Request          $request
     * @return RedirectResponse
     */
    public function resetPassword(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'user' => 'required',
            'password' => 'required',
            'password-confirmation' => 'required|same:password',
        ]);

        $existingUser = null;

        // Check if the given username corresponds to an existing admin
        $allUsers = Admin::all()->toArray();
        foreach ($allUsers as $user) {
            if ($user['user'] == $credentials['user']) {
                $existingUser = Admin::query()->where('user', $credentials['user'])->select('user')->first()->toArray();
            }
        }

        if($existingUser) {
            // Update password with a hashed value
            Admin::query()->update([
                'password' => Hash::make($credentials['password']), // The IDE proposed to Hash like this
            ]);
        }
        else
        {
            return redirect()->back();
        }


        return redirect()->intended('/');
    }
}
