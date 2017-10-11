<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\UnitRequest as StoreRequest;
use App\Http\Requests\UnitRequest as UpdateRequest;

class UnitCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Unit');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/unit');
        $this->crud->setEntityNameStrings('unit', 'units');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        //Customse column
        $this->crud->setColumns([
            [
                'name'  => 'block_id',
                'entity' => 'block',
                'attribute' => 'name',
                'label' => trans('ihome.block'),
                'type'  => 'select',
                'model'  => '\App\Models\Block',
            ],
        ]);

        $this->crud->addColumn([
          'name'  => 'name',
          'label' => trans('ihome.name'),
          'type'  => 'text',
        ]);

        $this->crud->addFields([
          [ // select_from_array
              'name' => 'properties_id',
              'label' => "Property",
              'type' => 'select2_from_array',
              'options'=> \App\Models\Properties::all()->pluck('name','id'),
              'allows_null' => false,
          ],
          [ // select_from_array
            'name' => 'block_id',
            'label' => trans('ihome.block'),
            'entity' => 'block',
            'attribute' => 'name',
            'type' => 'select2',
            'model'  => '\App\Models\Block',
            'allows_null' => false,
          ],
        ], 'create');

        $this->crud->addFields([
          [ // select_from_array
              'name' => 'properties_id',
              'label' => "Property",
              'type' => 'text',
              'attributes' => ['disabled' => 'disable'],
          ],
          [ // select_from_array
              'name' => 'block_name',
              'label' => "Block",
              'type' => 'text',
              'attributes' => ['disabled' => 'disable'],
          ],
          [ // select_from_array
              'name' => 'block_id',
              'type' => 'hidden',
              'attributes' => [
                 'class' => 'form-control hidden'
               ],
               'wrapperAttributes' => [
                 'class' => 'form-group col-md-12 hidden'
               ]
          ],
        ], 'update');

        $this->crud->addFields([
          [
              'name'  => 'name',
              'label' => trans('backpack::permissionmanager.name'),
              'type'  => 'text',
              'attributes' => [
                'required' => 'required',
              ]
          ],
          [
              'name'  => 'level',
              'label' => trans('ihome.level'),
              'type'  => 'text',
              'attributes' => [
                'required' => 'required',
              ]
          ],
          [
              'name'  => 'square_feet',
              'label' => trans('ihome.square_feet'),
              'type'  => 'text',
              'attributes' => [
                'required' => 'required',
              ]
          ],
        ], 'both');

        $this->crud->setCreateView('admin.unit.create');
        $this->crud->setEditView('admin.unit.edit');
    }

    public function edit($id)
    {
      $property = null;

      if($unit = \App\Models\Unit::all()->where('id',$id)->first())
      {
        if($block = $unit->block)
        {
          $property = $block->properties;
        }
      }

      $this->crud->hasAccessOrFail('update');

      // get the info for that entry
      $this->data['entry'] = $this->crud->getEntry($id);
      $this->data['crud'] = $this->crud;
      $this->data['saveAction'] = $this->getSaveAction();
      $this->data['fields'] = $this->crud->getUpdateFields($id);
      $this->data['title'] = trans('backpack::crud.edit').' '.$this->crud->entity_name;

      $this->data['id'] = $id;

      if($property)
      {
        $this->data['fields']['properties_id']['value'] = $property->name;
        $this->data['fields']['block_name']['value'] = $block->name;
      }

      return view($this->crud->getEditView(), $this->data);
    }

    public function store(StoreRequest $request)
    {
        $redirect_location = parent::storeCrud($request);
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $redirect_location = parent::updateCrud($request);
        return $redirect_location;
    }
}
