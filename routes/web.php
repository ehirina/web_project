<?php

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



Route::resource('clients', 'ClientController', ['only' => ['index', 'create', 'store', 'show', 'destroy']])->middleware('role:administrator');
Route::resource('users', 'UserController', ['only' => ['index', 'create', 'store', 'show', 'destroy']])->middleware('role:administrator');
Route::resource('assignments', 'AssignmentController', ['only' => ['index', 'create', 'store', 'show', 'destroy']])->middleware('role:administrator');


Route::get('/projects','ProjectController@index')->middleware('role:administrator|user');
Route::get('/projects/{id}', 'ProjectController@show')->middleware('role:administrator|user');

Route::post('/projects','ProjectController@store')->middleware('role:administrator');
Route::get('/projects/create','ProjectController@create')->middleware('role:administrator');
Route::get('/projects/{id}/delete',      'ProjectController@destroy')->middleware('role:administrator');

Route::resource('reports', 'TimeEntryController')->middleware('role:administrator|user');



//Route::get('/clients/create', 'ClientController@create');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
