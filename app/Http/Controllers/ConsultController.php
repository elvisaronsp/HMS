<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use Illuminate\Support\Facades\Auth;

class ConsultController extends Controller
{
    public function userView()
    {  
        return view('user.consult');
    }
    
    public function doctorView()
    {
        return view('doctor.consult');
    }
}
