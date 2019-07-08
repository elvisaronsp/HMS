<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Endorsement;

class EndorsementController extends Controller
{
    public function endorse(Request $request)
    {
        return response()->json(Endorsement::create([
            'user_id' => $request->user_id,
            'doctor_id' => $request->doctor_id
        ]));
    }
}
