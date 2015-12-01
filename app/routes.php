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

Route::get('trainings/{training_id}', 'TrainingsController@show');
Route::put('trainings', 'TrainingsController@update');

Route::get('trainings_attendees/list', 'TrainingsAttendeesController@index');
Route::post('trainings/{training_id}/attendees', 'TrainingsAttendeesController@store');

Route::get('trainings_attendees/{id}/approve', 'TrainingsAttendeesController@approve');
Route::get('trainings_attendees/{id}/disapprove', 'TrainingsAttendeesController@disapprove');

// search:
Route::get('search/attendees/worker_id/{worker_id}', 'SearchController@show');
Route::post('search/attendees/worker_id/{worker_id}', 'SearchController@attendees');

Route::post('register', 'UsersController@register');
Route::post('login', 'UsersController@login');
