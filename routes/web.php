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

Route::get('/projects',function(){
	return view('projects');
});


Route::resource('clients', 'ClientController');
//Route::post('/clients',                 'ClientController@store');

Route::resource('projects', 'ProjectController');
Route::resource('reports', 'TimeEntryController');

Route::resource('users', 'UserController');


Route::resource('assignments', 'AssignmentController');


//Route::get('/clients/create', 'ClientController@create');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
