<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\UserStoreCrudRequest as StoreRequest;
// VALIDATION
use App\Http\Requests\UserUpdateCrudRequest as UpdateRequest;
use Illuminate\Http\Request;

class UserCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel(config('backpack.permissionmanager.user_model'));
        $this->crud->setEntityNameStrings(trans('backpack::permissionmanager.user'), trans('backpack::permissionmanager.users'));
        $this->crud->setRoute(config('backpack.base.route_prefix').'/user');
        $this->crud->enableAjaxTable();

        $this->crud->setColumns([
            [
                'name'  => 'email',
                'label' => trans('backpack::permissionmanager.email'),
                'type'  => 'text',
            ],
        ]);

        $this->crud->addColumn([ // n-n relationship (with pivot table)
           'label'     => trans('backpack::permissionmanager.roles'), // Table column heading
           'type'      => 'select_multiple',
           'name'      => 'roles', // the method that defines the relationship in your Model
           'entity'    => 'roles', // the method that defines the relationship in your Model
           'attribute' => 'name', // foreign key attribute that is shown to user
           'model'     => "Backpack\PermissionManager\app\Models\Roles", // foreign key model
        ]);

        $this->crud->addColumn([ // n-n relationship (with pivot table)
           'label'     => trans('backpack::permissionmanager.extra_permissions'), // Table column heading
           'type'      => 'select_multiple',
           'name'      => 'permissions', // the method that defines the relationship in your Model
           'entity'    => 'permissions', // the method that defines the relationship in your Model
           'attribute' => 'name', // foreign key attribute that is shown to user
           'model'     => "Backpack\PermissionManager\app\Models\Permission", // foreign key model
        ]);

        $this->crud->addFields([
            [
                'name'  => 'email',
                'label' => trans('backpack::permissionmanager.email'),
                'type'  => 'email',
                'allows_null' => false,
            ],
            [
                'name'  => 'password',
                'label' => trans('backpack::permissionmanager.password'),
                'type'  => 'password',
                'allows_null' => false,
            ],
            [
                'name'  => 'password_confirmation',
                'label' => trans('backpack::permissionmanager.password_confirmation'),
                'type'  => 'password',
            ],
            [
              'name' => 'sep1',
              'value' => '<hr><h4>Profile</h4>',
              'type' => 'custom_html',
            ],
            [
                'name'  => 'first_name',
                'label' => trans('backpack::permissionmanager.first_name'),
                'type'  => 'text',
                'allows_null' => false,
            ],
            [
                'name'  => 'last_name',
                'label' => trans('backpack::permissionmanager.last_name'),
                'type'  => 'text',
                'allows_null' => false,
            ],
            [
                'name'  => 'ic_number',
                'label' => trans('backpack::permissionmanager.ic_number'),
                'type'  => 'text',
            ],
            [
                'name'  => 'passport',
                'label' => trans('backpack::permissionmanager.passport'),
                'type'  => 'text',
            ],
            [
                'name'  => 'nationality',
                'label' => trans('backpack::permissionmanager.nationality'),
                'type'  => 'text',
            ],
            [
                'name'  => 'emergency_contact_name',
                'label' => trans('backpack::permissionmanager.emergency_contact_no'),
                'type'  => 'text',
            ],
            [
                'name'  => 'emergency_contact_relationship',
                'label' => trans('backpack::permissionmanager.emergency_contact_relationship'),
                'type'  => 'text',
            ],
            [
                'name'  => 'emergency_contact_no',
                'label' => trans('backpack::permissionmanager.emergency_contact_no'),
                'type'  => 'text',
            ],
            [
                'name'  => 'SnP',
                'label' => trans('backpack::permissionmanager.SnP'),
                'type' => 'browse'
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
            [
                'name'  => 'race',
                'label' => trans('backpack::permissionmanager.race'),
                'type'  => 'text',
            ],
            [
                'name'  => 'contact_no',
                'label' => trans('backpack::permissionmanager.contact_no'),
                'type'  => 'text',
            ],
            [ // select_from_array
              'name' => 'status',
              'label' => trans('backpack::permissionmanager.status'),
              'type' => 'select_from_array',
              'options' => ['1' => 'Active', '0' => 'Inactive'],
              'default'    => '1',
              'allows_null' => false,
            ],
            [
            // two interconnected entities
            'label'             => trans('backpack::permissionmanager.user_role_permission'),
            'field_unique_name' => 'user_role_permission',
            'type'              => 'checklist_dependency',
            'name'              => 'roles_and_permissions', // the methods that defines the relationship in your Model
            'subfields'         => [
                    'primary' => [
                        'label'            => trans('backpack::permissionmanager.roles'),
                        'name'             => 'roles', // the method that defines the relationship in your Model
                        'entity'           => 'roles', // the method that defines the relationship in your Model
                        'entity_secondary' => 'permissions', // the method that defines the relationship in your Model
                        'attribute'        => 'name', // foreign key attribute that is shown to user
                        'model'            => "Backpack\PermissionManager\app\Models\Role", // foreign key model
                        'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
                        'number_columns'   => 3, //can be 1,2,3,4,6
                    ],
                    'secondary' => [
                        'label'          => ucfirst(trans('backpack::permissionmanager.permission_singular')),
                        'name'           => 'permissions', // the method that defines the relationship in your Model
                        'entity'         => 'permissions', // the method that defines the relationship in your Model
                        'entity_primary' => 'roles', // the method that defines the relationship in your Model
                        'attribute'      => 'name', // foreign key attribute that is shown to user
                        'model'          => "Backpack\PermissionManager\app\Models\Permission", // foreign key model
                        'pivot'          => true, // on create&update, do you need to add/delete pivot table entries?]
                        'number_columns' => 3, //can be 1,2,3,4,6
                    ],
                ],
            ],
        ]);
    }

    /**
     * Store a newly created resource in the database.
     *
     * @param StoreRequest $request - type injection used for validation using Requests
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->crud->hasAccessOrFail('create');

        // insert item in the db
        if ($request->input('password')) {
            $item = $this->crud->create(\Request::except(['redirect_after_save']));

            // now bcrypt the password
            $item->password = bcrypt($request->input('password'));
            $item->save();
        } else {
            $item = $this->crud->create(\Request::except(['redirect_after_save', 'password']));
        }

        //$item //user
        $item->user_profile()->create(request()->all());

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->setSaveAction();

        return $this->performSaveAction($item->getKey());
    }

    public function update(UpdateRequest $request)
    {
        //encrypt password and set it to request
        $this->crud->hasAccessOrFail('update');

        $dataToUpdate = \Request::except(['redirect_after_save', 'password']);

        //encrypt password
        if ($request->input('password')) {
            $dataToUpdate['password'] = bcrypt($request->input('password'));
        }

        // update the row in the db
        $this->crud->update(\Request::get($this->crud->model->getKeyName()), $dataToUpdate);

        $user = $this->crud->getEntry(\Request::get($this->crud->model->getKeyName()));
        $user->user_profile->update(request()->all());

        // show a success message
        \Alert::success(trans('backpack::crud.update_success'))->flash();

        // save the redirect choice for next time
        $this->setSaveAction();

        return $this->performSaveAction();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->crud->hasAccessOrFail('update');

        // get the info for that entry
        $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;
        $this->data['saveAction'] = $this->getSaveAction();
        $this->data['fields'] = $this->crud->getUpdateFields($id);
        $this->data['title'] = trans('backpack::crud.edit').' '.$this->crud->entity_name;

        $this->data['id'] = $id;

        $userProfile = $this->data['entry']->user_profile;
        $userProfileFields = $userProfile->toArray();

        foreach($userProfileFields as $fieldName => $field)
        {
          $this->data['fields'][$fieldName]['value'] = $field;
        }

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getEditView(), $this->data);
    }
}
