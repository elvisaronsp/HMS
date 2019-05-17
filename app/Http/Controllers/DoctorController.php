<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function test(Request $request)
    {
        dd(Auth::user());
    }

    public function index(Request $request)
    {
        return view('doctor.dashboard');
    }
}
