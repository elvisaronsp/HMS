<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prescription;
use App\Appointment;

class PrescriptionController extends Controller
{
    /**
     * Get prescription by id
     */
    public function show($id)
    {
        ## fetch prescription 
        $prescription = Prescription::where('id', $id)
            ->with('appointment', 'appointment.doctor', 'appointment.doctor.specialty')
            ->first();

    
        return view('user.show-prescription', compact('prescription'));
    }

    /**
     * Show prescription to doctor
     */
    public function showToDoctor($id)
    {
        ## fetch prescription 
        $prescription = Prescription::where('id', $id)
            ->with('appointment', 'appointment.doctor', 'appointment.doctor.specialty')
            ->first();


        return view('doctor.show-prescription', compact('prescription'));
    }

    /**
     * Create prescription
     */
    public function create(Request $request)
    {
        $prescription = Prescription::create([
            'appointment_id' => $request->appointment_id,
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
        ]);

        if($prescription) {
            return redirect()->to('/doctor/appointments');
        }
        return back();
    }

    /**
     * Show form to create prescription
     */
    public function createForm($id)
    {
        
        ## fetch appointment 
        $appointment = Appointment::where('id', $id)->with('user')->first();

        // return $appointment;
        return view('doctor.create-prescription', compact('appointment'));
    }
}
