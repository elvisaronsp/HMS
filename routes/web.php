<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('welcome');

Route::get('/auth', function() {
    return response()->json(auth()->user());
});

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'user'], function () {
    Route::get('/dashboard', 'UserController@index')->name('user.dashboard')->middleware('verified');
    Route::get('/appointments', 'AppointmentController@showAppointmentForm')->name('user.appointment.show');
    Route::post('/appointments/check/date', 'AppointmentController@checkFreeTimesByDate')->name('user.appointment.check.date');
    Route::post('/appointments/reserve', 'AppointmentController@reserve')->name('user.make.reservation');

    Route::get('/medical-history', 'MedicalHistoryController@index')->name('user.medical.history');
    Route::get('/prescription/{id}', 'PrescriptionController@show');

    Route::get('/consult', 'ConsultController@userView');
});

Route::group(['prefix' => 'doctor'], function () {
    Route::get('/login', 'Auth\DoctorAuthController@showLoginForm')->name('doctor.login');
    Route::post('/login', 'Auth\DoctorAuthController@login')->name('doctor.login.submit');

    Route::get('password-reset', 'Auth\DoctorPasswordController@showSendForm'); //I did not create this controller. it simply displays a view with a form to take the email
    Route::post('password-reset', 'Auth\DoctorPasswordController@sendPasswordResetToken')->name('doctor.reset.send');
    Route::get('/reset/{token}', 'Auth\DoctorPasswordController@showPasswordResetForm');
    Route::post('/reset/{token}', 'Auth\DoctorPasswordController@resetPassword')->name('doctor.update.password');

    Route::group(['middleware' => ['auth:doctor']], function () {
        Route::get('/dashboard', 'DoctorController@index')->name('doctor.dashboard');
        Route::get('/appointments', 'DoctorController@appointmentsForToday')->name('doctor.appointments.today');
        Route::get('/prescription/{id}', 'PrescriptionController@showToDoctor')->name('doctor.show.prescription');
        Route::get( '/prescription/new/{id}', 'PrescriptionController@createForm')->name('doctor.show-form.prescription');
        Route::post('/prescription/create', 'PrescriptionController@create')->name('doctor.create.prescription');
        Route::get('/appointments/archive', 'DoctorController@archived')->name('doctor.appointments.archived');
        Route::get('/consult', 'ConsultController@doctorView');

        Route::post('/logout', 'Auth\DoctorAuthController@logout')->name('doctor.logout');
    });
});

// routes for vue API
Route::post('/doctors', 'DoctorController@getDoctors');
Route::get('/conversation/with/doctor/{contact_id}/{user_id}', 'ChatController@getMessagesForUser');
Route::get('/conversation/with/user/{contact_id}/{doctor_id}', 'ChatController@getMessagesForDoctor');
Route::get('/doctor/contacts/{id}', 'ChatController@getDoctorContacts');

