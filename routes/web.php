<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', 'Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles']);
    Route::resource('divisions', 'Backend\DivisionController', ['names' => 'admin.divisions']);
    Route::post('division-status/{id}', 'Backend\DivisionController@changeStatus')->name('admin.divisions.status');
    Route::resource('users', 'Backend\UsersController', ['names' => 'admin.users']);
    Route::resource('colours', 'Backend\ColourController', ['names' => 'admin.colours']);
    Route::resource('brands', 'Backend\BrandController', ['names' => 'admin.brands']);
    Route::resource('vehicle-type', 'Backend\VehicleTypeController', ['names' => 'admin.vehicletypes']);

    Route::resource('service-type', 'Backend\ServiceTypeController', ['names' => 'admin.servicetypes']);
    Route::resource('units', 'Backend\UnitController', ['names' => 'admin.units']);
    Route::resource('spare-parts', 'Backend\SparePartsController', ['names' => 'admin.spareparts']);

    Route::resource('vehicles', 'Backend\VehicleController', ['names' => 'admin.vehicles']);
    Route::post('vehicle-category', 'Backend\VehicleController@category')->name('admin.vehiclecategory');
    Route::post('vehicle-showcolour', 'Backend\VehicleController@showColour')->name('admin.vehiShowcolour');
    Route::post('vehicle-addcolour', 'Backend\VehicleController@addColour')->name('admin.vehiAddcolour');

    Route::resource('assigns', 'Backend\AssignController', ['names' => 'admin.assigns']);

    Route::get('estimate/create', 'Backend\EstimateController@index')->name('admin.estimates.index');
    Route::get('get-servicetype', 'Backend\EstimateController@servicetype');
    Route::get('get-spartparts', 'Backend\EstimateController@spare_parts');
    Route::get('/get-cart-parts', 'Backend\EstimateController@get_cart_spare_parts');
    Route::post('add-cart-spareparts', 'Backend\EstimateController@cart_spare_parts')->name('admin.addCartParts');
    Route::get('delete-id-cart-spareparts/{id}', 'Backend\EstimateController@delete_id_cart_parts');

});
