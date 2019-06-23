<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\UserRequest as StoreRequest;
use App\Http\Requests\UserRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('user', 'users');

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
            'name' => 'email',
            'label' => "Email",
            'type' => 'email'
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
        $this->crud->addField([
            'name' => 'birthday',
            'label' => "Birthday",
            'type' => 'date'
        ]);
        $this->crud->addField([
            'name' => 'gender',
            'label' => "Gender",
            'type' => 'select_from_array',
            'options' => ['null' => 'Select Gender', 'male' => 'Male', 'female' => 'Female'],
            'allows_null' => false,
        ]);
        $this->crud->addField([
            'name' => 'phone',
            'label' => "Phone"
        ]);
        $this->crud->addField([
            'name' => 'address',
            'label' => "Address"
        ]);
        $this->crud->addField([
            'name' => 'password',
            'label' => "Password"
        ]);
        $this->crud->addField([
            'name' => 'email',
            'label' => "Email",
            'type' => 'email'
        ]);
        $this->crud->addField([   // Upload
            'name' => 'avatar',
            'label' => 'Avatar',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public'
        ]);
        $this->crud->addField([ // Select2 = 1-n relationship
            'label' => 'Blood Type',
            'type' => 'select',
            'name' => 'blood_type_id', // the db column for the foreign key
            'entity' => 'bloodType', // the method that defines the relationship in your Model
            'attribute' => 'title',
            'model' => "App\Models\BloodType",
        ]);
        $this->crud->addField([
            'name' => 'is_admin',
            'label' => "Administrator",
            'type' => 'select_from_array',
            'options' => ['0' => 'No', '1' => 'Yes',],
            'allows_null' => false,
        ]);

        // add asterisk for fields that are required in UserRequest
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
        $request->request->set('password', bcrypt($request->password));
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
