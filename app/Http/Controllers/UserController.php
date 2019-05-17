<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Specialty;
use App\Doctor;
use App\Appointment;

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
        return view('user.dashboard');
    }

    /**
     * Show Appointment form to check date
     */
    public function showAppointmentForm()
    {
        ## get specialties
        $specialties = Specialty::all();
        return view('user.appointments', compact( 'specialties'));
    }

    /**
     * Check free times by date
     */
    public function checkFreeTimesByDate(Request $request)
    {
        ## TODO:
        $freeDoctors = [];
        $workingHours = ['11:00', '12:00', '01:00', '02:00'];
        $doctorsBySpecialty = Doctor::all()->where('specialty_id', $request->specialty);

        foreach($doctorsBySpecialty as $doctor)
        {
            ## reserved times by doctor
            $doctorAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('date', $request->date)
            ->pluck('time')
            ->all();

            dd(array_filter( $workingHours, function($time) use ( $doctorAppointments) {
                 return (!in_array($time, $workingHours) );
                })
            );

        }
        return response()->json($doctorsBySpecialty);
    }
}
