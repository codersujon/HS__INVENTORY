<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $data = $request->all();
       
        // Email and Password Remmember for 3600second or 1hours
        if(isset($data['remember']) && !empty($data['remember'])){
            setcookie("email", $data['email'], time()+3600); 
            setcookie("password", $data['password'], time()+3600); 
        }else{
            setcookie("email", ""); 
            setcookie("password", ""); 
        }

        $request->session()->regenerate();
        flash()->flash('success', 'User Login Successfully!');
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        flash()->flash('success', 'User Logout Successfully!');
        return redirect('/');
    }
}
