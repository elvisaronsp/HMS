<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;

class ConsultController extends Controller
{
    public function index()
    {
        ## fetch all doctors
        $doctors = Doctor::with('specialty')->get();

        // return $doctors;
        return view('user.consult', compact('doctors'));
    }
}
