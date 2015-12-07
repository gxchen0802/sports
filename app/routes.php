<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    return View::make('hello');
});

Route::get('about', function()
{
    return View::make('pages.about'); // return View('pages.about');
});

Route::get('trainings', 'TrainingsController@index');
Route::get('trainings/create', 'TrainingsController@create');
Route::post('trainings', 'TrainingsController@store');
Route::get('trainings/{training_id}/delete', 'TrainingsController@destroy');
Route::get('trainings/{training_id}', 'TrainingsController@show');
Route::put('trainings', 'TrainingsController@update');


Route::get('trainings_attendees', 'TrainingsAttendeesController@index');
Route::get('trainings_attendees/list', 'TrainingsAttendeesController@index');
Route::post('trainings/{training_id}/attendees', 'TrainingsAttendeesController@store');

Route::get('trainings_attendees/{id}/approve', 'TrainingsAttendeesController@approve');
Route::get('trainings_attendees/{id}/disapprove', 'TrainingsAttendeesController@disapprove');

// search:
Route::get('search/attendees/worker_id/{worker_id}', 'SearchController@show');
Route::post('search/attendees/worker_id/{worker_id}', 'SearchController@attendees');

Route::post('register', 'UsersController@register');
Route::post('login', 'UsersController@login');

// Locations:
Route::get('locations', 'LocationsController@index');
Route::post('locations', 'LocationsController@store');
Route::get('locations/{id}/create', 'LocationsController@create');
Route::get('locations/{id}', 'LocationsController@show');
Route::get('locations/{id}/delete', 'LocationsController@destroy');
