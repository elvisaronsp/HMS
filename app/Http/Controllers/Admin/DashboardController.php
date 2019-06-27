<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Doctor;
use App\Models\User;
use App\Models\Appointment;

class DashboardController extends Controller {

    public function index()
    {
        $users = User::all()->count();
        $doctors = Doctor::all()->count();
        $appointments = Appointment::all()->count();
        
        return view('vendor.backpack.base.dashboard', compact('users', 'doctors', 'appointments'));
    }
}