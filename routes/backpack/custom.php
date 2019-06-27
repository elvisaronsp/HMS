<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::get('/dashboard', 'DashboardController@index');

    CRUD::resource('user', 'UserCrudController');
    CRUD::resource('doctor', 'DoctorCrudController');
    CRUD::resource('specialty', 'SpecialtyCrudController');
    CRUD::resource('appointment', 'AppointmentCrudController');
    CRUD::resource('workingHour', 'WorkingHourCrudController');
    CRUD::resource('doctorWorkingHour', 'DoctorWorkingHourCrudController');
    CRUD::resource('prescription', 'PrescriptionCrudController');
}); // this should be the absolute last line of this file