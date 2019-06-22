<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Auth;
use App\Events\NewMessage;

class ChatController extends Controller
{
    public function getMessagesForUser($contact_id, $user_id)
    {
        $messages = Message::where('user_id', $user_id)
            ->where('doctor_id', $contact_id)
            ->get();

        return response()->json($messages);
    }

    public function getMessagesForDoctor($contact_id, $doctor_id)
    {
        $messages = Message::where('doctor_id', $doctor_id)
            ->where('user_id', $contact_id)
            ->get();

        return response()->json($messages);
    }

    public function getDoctorContacts($id)
    {
        $contacts = Message::where('doctor_id', $id)
            ->select('user_id')
            ->groupBy('user_id')
            ->with('user')
            ->get();

        $reformatedContacts = [];

        foreach ($contacts as $contact) {
            $reformatedContacts[] = $contact->user;
        }


        return response()->json($reformatedContacts);
    }

    public function send(Request $request)
    {
       $message = Message::create([
            'user_id' => $request->user_id,
            'doctor_id' => $request->doctor_id,
            'content' => $request->content,
            'sent_by_doctor' => $request->sent_by_doctor
        ]);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
