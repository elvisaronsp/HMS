<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AppointmentRequest as StoreRequest;
use App\Http\Requests\AppointmentRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use App\WorkingHour;
use Illuminate\Support\Str;

/**
 * Class AppointmentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AppointmentCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Appointment');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/appointment');
        $this->crud->setEntityNameStrings('appointment', 'appointments');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumn([
            'label' => "User",
            'type' => 'select',
            'name' => 'user_id',
            'entity' => 'user',
            'attribute' => 'full_name',
            'model' => "App\Models\User"
        ]);
        $this->crud->addColumn([
            'label' => "Doctor",
            'type' => 'select',
            'name' => 'doctor_id',
            'entity' => 'doctor',
            'attribute' => 'full_name',
            'model' => "App\Models\Doctor"
        ]);
        $this->crud->addColumn([
            'name' => 'time',
            'label' => "Time"
        ]);
        $this->crud->addColumn([
            'name' => 'date',
            'label' => "Date"
        ]);

        $this->crud->addField([ // Select2 = 1-n relationship
            'label' => "User",
            'type' => 'select2',
            'name' => 'user_id',
            'entity' => 'user',
            'attribute' => 'full_name',
            'model' => "App\Models\User"
        ]);
        $this->crud->addField([
            'label' => "Doctor",
            'type' => 'select2',
            'name' => 'doctor_id',
            'entity' => 'doctor',
            'attribute' => 'full_name',
            'model' => "App\Models\Doctor"
        ]);

        ## map times for admin
        $times = WorkingHour::all();
        $mappedTimes = [];
        foreach($times as $time)
        {
            
            $mappedTimes[$time->time] = Str::limit($time->time, 5, '');
        }
        $this->crud->addField([
            'name' => 'time',
            'label' => "Time",
            'type' => 'select_from_array',
            'options' => $mappedTimes,
            'allows_null' => false,
        ]);
        $this->crud->addField([
            'name' => 'date',
            'label' => "Date",
            'type' => 'date'
        ]);
        
        
        // add asterisk for fields that are required in AppointmentRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
