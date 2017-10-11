<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PropertiesRequest as StoreRequest;
use App\Http\Requests\PropertiesRequest as UpdateRequest;

class PropertiesCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Properties');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/properties');
        $this->crud->setEntityNameStrings('properties', 'properties');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setColumns([
            [
                'name'  => 'name',
                'label' => trans('backpack::permissionmanager.name'),
                'type'  => 'text',
            ],
        ]);

        //$this->crud->setFromDb();
        $this->crud->addFields([
          [
              'name'  => 'name',
              'label' => trans('backpack::permissionmanager.name'),
              'type'  => 'text',
          ],
          [
              'name'  => 'seperator1',
              'value' => "<hr><h4>Address</h4>",
              'type'  => 'custom_html',
          ],
          [
              'name'  => 'location',
              'label' => trans('backpack::permissionmanager.location'),
              'type'  => 'address',
              'store_as_json' => true,
          ],
          [
              'name'  => 'street',
              'label' => trans('backpack::permissionmanager.street'),
              'type'  => 'text',
          ],
          [
              'name'  => 'city',
              'label' => trans('backpack::permissionmanager.city'),
              'type'  => 'text',
          ],
          [
              'name'  => 'state',
              'label' => trans('backpack::permissionmanager.state'),
              'type'  => 'text',
          ],
          [
              'name'  => 'country',
              'label' => trans('backpack::permissionmanager.country'),
              'type'  => 'text',
          ],
          [
              'name'  => 'zip',
              'label' => trans('backpack::permissionmanager.zip'),
              'type'  => 'text',
          ],
        ]);

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
