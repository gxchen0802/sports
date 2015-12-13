<?php

// Route::get('/', function()
// {
//     return View::make('hello');
// });

Route::get('/', 'LandingController@index');


Route::get('about', function()
{
    return View::make('pages.about'); // return View('pages.about');
});

## Trainings:
Route::get('trainings', 'TrainingsController@index');
Route::get('trainings/create', 'TrainingsController@create');
Route::get('trainings/{id}/edit', 'TrainingsController@edit');
Route::post('trainings/{id}/update', 'TrainingsController@update');
Route::post('trainings', 'TrainingsController@store');

Route::get('trainings/{training_id}/delete', 'TrainingsController@destroy');
Route::get('trainings/{training_id}', 'TrainingsController@show');
Route::put('trainings', 'TrainingsController@update');

## Attend training:
Route::get('trainings_attendees', 'TrainingsAttendeesController@index');
Route::get('trainings_attendees/list', 'TrainingsAttendeesController@index');
Route::post('trainings/{training_id}/attendees', 'TrainingsAttendeesController@store');

Route::get('trainings_attendees/{id}/approve', 'TrainingsAttendeesController@approve');
Route::get('trainings_attendees/{id}/disapprove', 'TrainingsAttendeesController@disapprove');

// search:
// Route::get('search/attendees/worker_id/{worker_id}', 'SearchController@show');
// Route::post('search/attendees/worker_id/{worker_id}', 'SearchController@attendees');

## Users
Route::post('register', 'UsersController@register');
Route::post('login', 'UsersController@login');

## Locations:
Route::get('locations', 'LocationsController@index');
Route::get('locations/create', 'LocationsController@create');
Route::get('locations/{id}/edit', 'LocationsController@edit');
Route::post('locations/{id}/update', 'LocationsController@update');

Route::post('locations', 'LocationsController@store');
// Route::get('locations/{id}/create', 'LocationsController@create');
Route::post('locations/{id}/rent', 'LocationsController@rent');
Route::get('locations_rent/search', 'LocationsController@searchForm');
Route::post('locations_rent/search', 'LocationsController@search');

Route::get('locations_rent/audit', 'LocationsController@audit');
Route::get('locations_rent/{id}/approve', 'LocationsController@approve');
Route::get('locations_rent/{id}/disapprove', 'LocationsController@disapprove');

Route::get('locations/{id}', 'LocationsController@show');
Route::get('locations/{id}/delete', 'LocationsController@destroy');

## News
Route::get('cms/news', 'NewsController@index');
Route::get('/news/{id}', 'NewsController@show');
Route::get('cms/news/create', 'NewsController@create');
Route::post('cms/news/create', 'NewsController@store');
Route::get('cms/news/edit', 'NewsController@edit');
Route::post('cms/news/update', 'NewsController@update');
Route::get('cms/news/{id}/delete', 'NewsController@destroy');
