<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    protected function validator($data)
    {
        return Validator::make($data, []);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     * @param Request $request
     * @return
     */
    protected function create(Request $request)
    {
        ## save photo in avatars
        $avatarFile = $request->file('avatar')->store('avatars', 'public');
        ## create user
        return User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'blood_type_id' => $request->bloodtype,
            'avatar' => asset('storage/'. $avatarFile)
        ]);
    }
}
