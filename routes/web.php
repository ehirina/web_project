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
    return redirect('/login');
});



Route::resource('clients', 'ClientController', ['only' => ['index', 'create', 'store', 'show', 'destroy']])->middleware('role:administrator');
Route::get('/clientinfo', 'ClientController@show_detailed_info')->middleware('role:administrator');
Route::resource('users', 'UserController', ['only' => ['index', 'create', 'store','destroy']])->middleware('role:administrator');
Route::resource('assignments', 'AssignmentController', ['only' => ['index', 'create', 'store', 'show', 'destroy']])->middleware('role:administrator');


Route::get('/projects','ProjectController@index')->middleware('role:administrator|user');
Route::get('/projects/create','ProjectController@create')->middleware('role:administrator')
														 ->name('projects.create');
Route::get('/projects/{id}', 'ProjectController@show')->middleware('role:administrator')->name('projects.show');

Route::post('/projects','ProjectController@store')->middleware('role:administrator|user');
Route::get('/allprojects','ProjectController@indexAll')->middleware('role:administrator');
Route::get('/projects/{id}/delete',      'ProjectController@destroy')->middleware('role:administrator');
Route::get('/projectinfo', 'ProjectController@show_detailed_info')->middleware('role:administrator');
Route::get('/projectdetails/{id}','ProjectController@show_user_info')->middleware('role:administrator|user');


Route::resource('reports', 'ReportController')->middleware('role:administrator|user');
Route::get('/reports', 'ReportController@show_reports_period')->middleware('role:administrator|user')->name('reports-bydate.index');
// Route::get('reports/{id}/edit', 'ReportController@edit')->middleware('role:administrator|user')->name('reports.edit');



//Route::get('/clients/create', 'ClientController@create');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
