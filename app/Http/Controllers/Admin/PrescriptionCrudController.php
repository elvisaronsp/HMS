<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PrescriptionRequest as StoreRequest;
use App\Http\Requests\PrescriptionRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class PrescriptionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PrescriptionCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Prescription');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/prescription');
        $this->crud->setEntityNameStrings('prescription', 'prescriptions');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumn([
            'name' => 'treatment',
            'label' => "Treatment",
        ]);
        $this->crud->addColumn([
            'name' => 'diagnosis',
            'label' => "Diagnosis",
        ]);
        $this->crud->addColumn([
            // run a function on the CRUD model and show its return value
            'name' => "appointment_id",
            'label' => "Appointment N#", // Table column heading
            'type' => "model_function",
            'function_name' => 'getAppointmentLink', // the method in your Model
            'function_parameters' => ['appointment_id'], // pass one/more parameters to that method
            // 'limit' => 100, // Limit the number of characters shown
        ]);

        $this->crud->addField([ // Select2 = 1-n relationship
            'label' => 'Appointment',
            'type' => 'select2',
            'name' => 'appointment_id', // the db column for the foreign key
            'entity' => 'appointment', // the method that defines the relationship in your Model
            'attribute' => 'date_time',
            'model' => "App\Models\Appointment",
        ]);
        $this->crud->addField([
            'name' => 'diagnosis',
            'label' => "Diagnosis",
            'type' => 'wysiwyg'
        ]);
        $this->crud->addField([
            'name' => 'treatment',
            'label' => "Treatment",
            'type' => 'wysiwyg'
        ]);

        // add asterisk for fields that are required in PrescriptionRequest
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
