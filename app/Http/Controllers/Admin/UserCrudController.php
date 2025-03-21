<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class UserCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel('App\Models\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/admin-users');
        $this->crud->setEntityNameStrings('user', 'users');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/test-users');

    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'id', 'type' => 'number']);
        $this->crud->addColumn(['name' => 'name', 'type' => 'text']);
        $this->crud->addColumn(['name' => 'email', 'type' => 'email']);
        $this->crud->addColumn(['name' => 'created_at', 'type' => 'datetime']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(UserRequest::class);

        $this->crud->addField(['name' => 'name', 'type' => 'text']);
        $this->crud->addField(['name' => 'email', 'type' => 'email']);
        $this->crud->addField(['name' => 'password', 'type' => 'password']);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
