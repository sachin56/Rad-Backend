<?php

namespace App\Http\Controllers\Veterinarian;

use App\Models\Veterinarian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VeterinarianLoginController extends Controller
{
    public function index()
    {
        return view('veterinarian.auth.login');
    }

    public function checklogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Veterinarian::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'The provided email does not exist.',
            ])->onlyInput('email');
        }

        if ($user->status !== 'Y') {
            return back()->withErrors([
                'email' => 'Your account is not active. Please contact support.',
            ])->onlyInput('email');
        }

        if (Auth::guard('veterinarian')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('veterinarian.dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(){
        Auth::guard('veterinarian')->logout();
        return redirect()->route('veterinarian.login')->withSuccess('You have successfully logout in!');
    }
}
