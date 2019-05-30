<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use App\Specialty;
use Illuminate\Http\Request;

class AppointmentController extends Controller
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
     * Show Appointment form to check date
     */
    public function showAppointmentForm(Request $request)
    {
        ## get specialties
        $specialties = Specialty::all();
        return view('user.appointments', compact('specialties'));
    }

    /**
     * Check free times by date
     */
    public function checkFreeTimesByDate(Request $request)
    {
        ## query doctors by specialty
        $doctorsBySpecialty = Doctor::all()->where('specialty_id', $request->specialty);
        ## prepare free hours array
        $doctorsWithFreeHours = [];
        ## loop through doctors
        foreach ($doctorsBySpecialty as $doctor) {
            ## reserved times by single doctor
            $doctorAppointments = Appointment::where('doctor_id', $doctor->id)
                ->where('date', $request->date)
                ->pluck('time')
                ->all();
            ## fetch working hours of single doctor
            $doctorWorkingHours = $doctor->workingHours()->toArray();
            ## find difference between reserved and working hours
            $filteredHours = array_diff($doctorWorkingHours, $doctorAppointments);
            ## build free hours object
            $doctorsWithFreeHours[] = [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'surname' => $doctor->surname,
                'avatar' => $doctor->image,
                'freeHours' => $filteredHours
            ];
        }
        ## get query date
        $queryDate = $request->date;
        ## return response
        return view('user.free-times', compact('doctorsWithFreeHours', 'queryDate'));
    }

    /*
     * Make reservation
     */
    public function reserve(Request $request)
    {
        ## create appointment
        $reservation = Appointment::create(
            [
                'user_id' => $request->user_id,
                'doctor_id' => $request->doctor_id,
                'date' => $request->date,
                'time' => $request->freeHour
            ]
        );

        ## TODO: send email

        return view('user.appointments-success', compact('reservation'));
    }
}
