<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('welcome');

Auth::routes(['verify' => true]);

Route::get('/test', function() {
    dd(Auth::user());
});
Route::group(['prefix' => 'user'], function () {
    Route::get('/dashboard', 'UserController@index')->name('user.dashboard')->middleware('verified');
    Route::get('/appointments', 'UserController@showAppointmentForm')->name('user.appointments');
    Route::post('/appointments/check/date', 'UserController@checkFreeTimesByDate')->name('user.check.date');

});

Route::group(['prefix' => 'doctor'], function () {
    Route::get('/login', 'Auth\DoctorAuthController@showLoginForm')->name('doctor.login');
    Route::post('/login', 'Auth\DoctorAuthController@login')->name('doctor.login.submit');


    Route::get('password-reset', 'Auth\DoctorPasswordController@showSendForm'); //I did not create this controller. it simply displays a view with a form to take the email
    Route::post('password-reset', 'Auth\DoctorPasswordController@sendPasswordResetToken')->name('doctor.reset.send');
    Route::get('/reset/{token}', 'Auth\DoctorPasswordController@showPasswordResetForm');
    Route::post('/reset/{token}', 'Auth\DoctorPasswordController@resetPassword')->name('doctor.update.password');

    Route::group(['middleware' => ['auth:doctor']], function () {
        Route::get('/test', 'DoctorController@test');
        Route::get('/dashboard', 'DoctorController@index')->name('doctor.dashboard');
        Route::post('/logout', 'Auth\DoctorAuthController@logout')->name('doctor.logout');
    });
});


