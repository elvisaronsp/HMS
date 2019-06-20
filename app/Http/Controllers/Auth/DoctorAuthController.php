<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorAuthController extends Controller
{
    protected $redirectTo = '/doctor/dashboard';
    protected $guard = 'doctor';

    /**
     * DoctorAuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest:doctor', ['except' => ['logout'] ]);
        $this->middleware('doctor');
    }

    public function showLoginForm()
    {
        return view('auth.doctor.login');
    }

     public function login(Request $request)
     {
        if(
            Auth::guard('doctor')->attempt(
                [
                    'email' => request('email'), 'password' => request('password')
                ]
            )
        )
        {
            return redirect()->intended(route('doctor.dashboard'));
        } else {
            return redirect()->back()->withInput($request->only('email'));
        }
     }

    public function logout(Request $request)
    {
        Auth::guard('doctor')->logout();

        return redirect('/');
    }
}
