<?php

namespace App\Http\Controllers\PetSitter;

use App\Models\PetSitter;
use App\Models\ShopVendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PetSitterLoginController extends Controller
{
    public function index()
    {
        return view('petsitter.auth.login');
    }

    public function checklogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = PetSitter::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'The provided email does not exist.',
            ])->onlyInput('email');
        }


        if (Auth::guard('petsitter')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('pet-sitter.dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(){
        Auth::guard('petsitter')->logout();
        return redirect()->route('shop-vendor.logout')->withSuccess('You have successfully logout in!');
    }
}
