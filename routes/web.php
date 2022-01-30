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
});


