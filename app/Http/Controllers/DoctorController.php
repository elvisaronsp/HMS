<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Appointment;
use App\Doctor;

class DoctorController extends Controller
{

    public function index(Request $request)
    {
        ## fetch single upcoming doctor appointments
        $upcomingAppointment = Auth::user()
            ->appointments()
            ->where('date', '>=', Carbon::now())
            ->with('user')
            ->first();

        
        // return $upcomingAppointment;
        return view('doctor.dashboard', compact('upcomingAppointment'));
    }

    public function appointmentsForToday()
    {
        ## fetch appointments for today
        $appointmentForToday = Auth::user()
            ->appointments()
            ->where('date', Carbon::now()->toDateString())
            ->with('user', 'prescription')
            ->get();

        // return $appointmentForToday;
        return view('doctor.appointments', compact( 'appointmentForToday'));
    }

    public function archived()
    {
        ## fetch archived appointments
        $archived = Appointment::where('date', '<', Carbon::now()->toDateString())
            ->paginate(4);
        
        return view('doctor.archive', compact('archived'));
    }

    public function getDoctors()
    {
        return response()->json( Doctor::all());
    }
}
