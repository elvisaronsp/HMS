<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prescription;

class PrescriptionController extends Controller
{
    /**
     * Get prescription by id
     */
    public function show($id)
    {
        ## fetch prescription 
        $prescription = Prescription::find($id)
            ->with('appointment', 'appointment.doctor', 'appointment.doctor.specialty')
            ->first();

        
        return view('user.show-prescription', compact('prescription'));
    }
}
