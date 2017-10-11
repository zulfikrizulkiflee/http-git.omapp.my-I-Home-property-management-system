<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth'], 'namespace' => 'Admin'], function () {
	CRUD::resource('user', 'UserCrudController');
  CRUD::resource('properties', 'PropertiesCrudController');
  CRUD::resource('block', 'BlockCrudController');
  CRUD::resource('unit', 'UnitCrudController');

  //to return all the block within this property
  Route::get('unit/block_with_property_id/{property_id}', function ($property_id) {
      return \App\Models\Block::where('properties_id', $property_id)->paginate();
  });
});
