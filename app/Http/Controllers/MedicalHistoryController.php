<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MedicalHistoryController extends Controller
{
    public function index()
    {
        ## fetch all appointments made by user
        $medicalHistory = Auth::user()
            ->appointments()
            ->with('prescription', 'doctor')
            ->where('date', '<', Carbon::now())
            ->orderBy('date', 'desc')
            ->paginate(4);

            // return $medicalHistory;
        return view('user.medical-history', compact('medicalHistory'));
    }
}
