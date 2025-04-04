<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SubtaskRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class SubtaskCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Subtask::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/subtask');
        CRUD::setEntityNameStrings('subtask', 'subtasks');
    }

    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'is_completed',
            'label' => 'Completed',
            'type' => 'boolean',
        ]);

        CRUD::addColumn([
            'name' => 'task_id',
            'label' => 'Task',
            'type' => 'select',
            'entity' => 'task',
            'attribute' => 'title',
            'model' => \App\Models\Task::class,
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(SubtaskRequest::class);

        CRUD::addField([
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'is_completed',
            'label' => 'Completed',
            'type' => 'checkbox',
        ]);

        CRUD::addField([
            'name' => 'task_id',
            'label' => 'Task',
            'type' => 'select2',
            'entity' => 'task',
            'attribute' => 'title',
            'model' => \App\Models\Task::class,
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
