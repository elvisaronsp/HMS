<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\DoctorRequest as StoreRequest;
use App\Http\Requests\DoctorRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class DoctorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class DoctorCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Doctor');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/doctor');
        $this->crud->setEntityNameStrings('doctor', 'doctors');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        ## Custom columns;
        $this->crud->addColumn([
            'name' => 'name',
            'label' => "Name",
        ]);
        $this->crud->addColumn([
            'name' => 'surname',
            'label' => "Surname",
        ]);
        $this->crud->addColumn([
            'label' => "Specialty",
            'type' => 'select',
            'name' => 'specialty_id',
            'entity' => 'specialty',
            'attribute' => 'title',
            'model' => "App\Models\Specialty"
        ]);

        ## Custom fields
        $this->crud->addField([
            'name' => 'name',
            'label' => "Name"
        ]);
        $this->crud->addField([
            'name' => 'surname',
            'label' => "Surname"
        ]);
        $this->crud->addField([ // Select2 = 1-n relationship
            'label' => 'Specialty',
            'type' => 'select',
            'name' => 'specialty_id', // the db column for the foreign key
            'entity' => 'specialty', // the method that defines the relationship in your Model
            'attribute' => 'title',
            'model' => "App\Models\Specialty",
        ]);
        $this->crud->addField([
            'name' => 'phone',
            'label' => "Phone"
        ]);
        $this->crud->addField([
            'name' => 'email',
            'label' => "Email",
            'type' => 'email'
        ]);
        $this->crud->addField([
            'name' => 'password',
            'label' => "Password",
        ]);
        $this->crud->addField([   // Upload
            'name' => 'avatar',
            'label' => 'Avatar',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public'
        ]);
        $this->crud->addField([ // Select2 = 1-n relationship
            'label' => "Working Hours",
            'type' => 'select2_multiple',
            'name' => 'workingHours', // the method that defines the relationship in your Model
            'entity' => 'workingHours', // the method that defines the relationship in your Model
            'attribute' => 'time', // foreign key attribute that is shown to user
            'model' => "App\Models\WorkingHour", // foreign key model
            'pivot' => 'true'
        ]);
        $this->crud->addField([
            'name' => 'about',
            'label' => "About",
            'type' => 'wysiwyg'
        ]);
        

        // add asterisk for fields that are required in DoctorRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $request->request->set('password', bcrypt($request->password));
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
