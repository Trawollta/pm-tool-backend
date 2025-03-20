<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TaskRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TaskCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TaskCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Task::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/task');
        CRUD::setEntityNameStrings('task', 'tasks');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name'  => 'title',
            'label' => 'Title',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name'  => 'description',
            'label' => 'Description',
            'type'  => 'textarea',
        ]);
        $this->crud->addColumn([
            'name'  => 'due_date',
            'label' => 'Due Date',
            'type'  => 'date',
        ]);
        $this->crud->addColumn([
            'name'  => 'creator',
            'label' => 'Creator',
            'type'  => 'number',
        ]);
        $this->crud->addColumn([
            'name'  => 'progress',
            'label' => 'Progress (%)',
            'type'  => 'number',
        ]);
        $this->crud->addColumn([
            'name'  => 'assignees',
            'label' => 'Assignees',
            'type'  => 'array', // Zeigt ein Array als Liste an.
        ]);
        $this->crud->addColumn([
            'name'  => 'labels',
            'label' => 'Labels',
            'type'  => 'array',
        ]);
    }
    

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(TaskRequest::class);
        // Manuelle Felder, um z. B. ein schönes Dropdown für "assignees" anzuzeigen:
        $this->crud->addField([
            'name'  => 'title',
            'label' => 'Title',
            'type'  => 'text',
        ]);
        $this->crud->addField([
            'name'  => 'description',
            'label' => 'Description',
            'type'  => 'textarea',
        ]);
        $this->crud->addField([
            'name'  => 'due_date',
            'label' => 'Due Date',
            'type'  => 'date',
        ]);
        // Hier könnte der Creator-Feld automatisch gesetzt oder als Zahl eingegeben werden:
        $this->crud->addField([
            'name'  => 'creator',
            'label' => 'Creator',
            'type'  => 'number',
            'default' => auth()->id(), // falls du den aktuell angemeldeten User verwenden möchtest
        ]);
        // Dropdown für Assignees (als Array von User-IDs)
        $users = \App\Models\User::all()->pluck('name', 'id')->toArray();
        $this->crud->addField([
            'name'  => 'assignees',
            'label' => 'Assignees',
            'type'  => 'select2_from_array',
            'options' => $users,
            'allows_null' => true,
            'multiple' => true,
        ]);
        // Feld für Labels (du könntest hier auch ein mehrzeiliges Textfeld oder ein Dropdown definieren)
        $this->crud->addField([
            'name'  => 'labels',
            'label' => 'Labels',
            'type'  => 'select2_from_array',
            'options' => ['To Do' => 'To Do', 'In Progress' => 'In Progress', 'Waiting' => 'Waiting', 'Done' => 'Done'],
            'allows_null' => true,
            'multiple' => true,
        ]);
        // Optional: Progress-Feld
        $this->crud->addField([
            'name'  => 'progress',
            'label' => 'Progress (%)',
            'type'  => 'number',
            'default' => 0,
        ]);
    }
    

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
