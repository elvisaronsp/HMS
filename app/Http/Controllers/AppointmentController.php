<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use App\Specialty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        ## current date
        $today = Carbon::now()->format('Y-m-d');
        return view('user.appointments', compact('specialties', 'today'));
    }

    /**
     * Check free times by date
     */
    public function checkFreeTimesByDate(Request $request)
    {
        ## fetch current date and time
        $currentTime = Carbon::now()->toTimeString();
        $currentDate = Carbon::now()->toDateString();
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
            $freeHours = array_diff($doctorWorkingHours, $doctorAppointments);
            ## filter past times
            if ($currentDate == $request->date) {
                $freeHours = array_filter($freeHours, function ($hour) use ($currentTime) {
                    ## filter time which is bigger than current time
                    return ($hour > $currentTime);
                });
            }
            ## build free hours object
            $doctorsWithFreeHours[] = [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'surname' => $doctor->surname,
                'avatar' => $doctor->image,
                'freeHours' => $freeHours
            ];
        }
        ## get query date
        $queryDate = $request->date;
        ## return response
        return view('user.free-times', compact('doctorsWithFreeHours', 'queryDate', 'today'));
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

        #get instance
        $appointment = Appointment::find($reservation->id)->with('doctor')->first();

        $email = Auth::user()->email; // or $email = $tokenData->email;

        Mail::send(
            'emails.appointment',
            [
                'title' => 'Appointment',
                'content' => $appointment,
                'subject' => 'Appointment',
                'user' => Auth::user()->name,
                'app_link' => env('APP_URL')
            ],
            function ($message) use ($email) {
                $message->from('hms@gmail.com', 'HMS');

                $message->to($email);
            }
        );

        return view('user.appointments-success', compact('reservation'));
    }
}
