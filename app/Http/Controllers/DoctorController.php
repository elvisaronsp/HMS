<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Appointment;
use App\Doctor;
use App\Http\Requests\FirstDoctorLoginRequest;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::user()->last_login == null) {
            return view('doctor.reset-password');
        } else {
            ## fetch single upcoming doctor appointments
            $upcomingAppointment = Auth::user()
                ->appointments()
                ->where('date', '>=', Carbon::now())
                ->with('user')
                ->first();


            // return $upcomingAppointment;
            return view('doctor.dashboard', compact('upcomingAppointment'));
        }
    }

    public function firstLogin(FirstDoctorLoginRequest $request)
    {

        $checkHash = Hash::check($request->old_password, Auth::user()->password);

        if(!$checkHash) {
            return back()->withErrors(['old_password' => 'Invalid password']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password),
            'last_login' => Carbon::now()
        ]);

        return redirect('/') ;
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
