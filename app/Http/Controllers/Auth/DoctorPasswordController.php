<?php

namespace App\Http\Controllers\Auth;

use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DoctorPasswordController
{
    public function showSendForm()
    {
        return view('auth.doctor.passwords.email');
    }

    public function sendPasswordResetToken(Request $request)
    {
        ## check user existence in our database
        $user = Doctor::where('email', $request->email)->first();
        if ( !$user ) return redirect()->back()->withErrors(['email' => 'Email was not found']);

        ## Generate random string
        $token = Str::random(60);

        ## create a new token to be sent to the user.
        DB::table('password_resets')->updateOrInsert(
            [
                'email' => $request->email
            ],
            [
                'email' => $request->email,
                'token' => $token, //change 60 to any length you want
                'created_at' => Carbon::now()
            ]
        );

        ## Prepare content
        $email = $request->email; // or $email = $tokenData->email;
        $content = url( 'doctor/reset/' . $token);

        Mail::send('emails.doctor-password-reset',
            ['title' => 'Password Reset', 'content' => $content],
            function ($message) use ($email)
        {
            $message->from('hms@gmail.com', 'HMS');

            $message->to($email);
        });

        ## redirect after sent
        return view('auth.doctor.passwords.email-sent');
    }

    public function showPasswordResetForm($token)
    {
        ## Query data with token
        $tokenData = DB::table('password_resets')
            ->where('token', $token)->first();

        ## Validate result
        if ( !$tokenData ) return redirect()->to('/');
        return view('auth.doctor.passwords.reset', compact('token'));
    }

    public function resetPassword(Request $request, $token)
    {
        ## Get form data
        $password = $request->password;

        ## Validate user
        $tokenData = DB::table('password_resets')
            ->where('token', $token)->first();
        $user = Doctor::where('email', $tokenData->email)->first();
        if (!$user) return redirect()->to('home'); //or wherever you want

        ## Hash new password and update doctor
        $user->password = Hash::make($password);
        $user->save(); //or $user->save();

        ## If the user shouldn't reuse the token later, delete the token
        DB::table('password_resets')->where('email', $user->email)->delete();

        ## redirect
        return redirect()->route('doctor.login');
    }
}