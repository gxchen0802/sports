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

Route::resource('trainings', 'TrainingsController');
Route::put('trainings', 'TrainingsController@update');

Route::resource('trainings/{training_id}/attendees', 'TrainingsAttendeesController');

Route::post('register', 'UsersController@register');
Route::post('login', 'UsersController@login');
