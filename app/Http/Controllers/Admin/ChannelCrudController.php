<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ChannelRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ChannelCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ChannelCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Channel::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/channel');
        CRUD::setEntityNameStrings('channel', 'channels');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // Spalte für den Namen des Channels
        $this->crud->addColumn([
            'name'  => 'name',
            'label' => 'Name',
            'type'  => 'text',
        ]);
    
        // Spalte für die Beschreibung
        $this->crud->addColumn([
            'name'  => 'description',
            'label' => 'Description',
            'type'  => 'textarea',
        ]);
    
        // Spalte für den Creator
        $this->crud->addColumn([
            'name'  => 'creator',
            'label' => 'Creator',
            'type'  => 'text',
        ]);
    
        // Spalte für die Members. Wenn diese als Array gespeichert werden, kannst du den Typ 'array' nutzen.
        $this->crud->addColumn([
            'name'  => 'members',
            'label' => 'Members',
            'type'  => 'array',
        ]);
    }
    
    
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ChannelRequest::class);
        $this->crud->addField([
            'name'  => 'name',
            'label' => 'Name',
            'type'  => 'text',
        ]);
        // Weitere Felder hinzufügen...
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
