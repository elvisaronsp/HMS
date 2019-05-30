<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        ## fetch single upcoming user appointments
        $upcomingAppointment = Auth::user()
            ->appointments()
            ->where('date', '>=', Carbon::now())
            ->with('doctor', 'doctor.specialty')
            ->first();

        ## fetch all future user appointments
        $futureAppointments = Auth::user()
            ->appointments()
            ->where('date', '>=', Carbon::now())
            ->with('doctor', 'doctor.specialty')
            ->get();
        
        return view('user.dashboard', compact('upcomingAppointment', 'futureAppointments'));
    }
}
