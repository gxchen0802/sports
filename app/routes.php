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

## Login & Register:
Route::get('login', 'UsersController@login');
Route::post('register', 'UsersController@register');
Route::post('signin', 'UsersController@signin');

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

## Search:
Route::get('search', 'SearchController@show');
// Route::get('search/attendees/worker_id/{worker_id}', 'SearchController@show');
// Route::post('search/attendees/worker_id/{worker_id}', 'SearchController@attendees');

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

## Articles:
Route::get('/news/{id}', 'NewsController@show');
Route::get('cms/news', 'NewsController@index');
Route::get('cms/news/create', 'NewsController@create');
Route::post('cms/news/create', 'NewsController@store');
Route::get('cms/news/{id}/edit', 'NewsController@edit');
Route::post('cms/news/{id}/update', 'NewsController@update');
Route::get('cms/news/{id}/delete', 'NewsController@destroy');

## Categories:
Route::get('/categories/{id}', 'CategoriesController@show');
Route::get('cms/categories', 'CategoriesController@index');
Route::get('cms/categories/create', 'CategoriesController@create');
Route::post('cms/categories', 'CategoriesController@store');
Route::get('cms/categories/{id}/edit', 'CategoriesController@edit');
Route::post('cms/categories/{id}/update', 'CategoriesController@update');
Route::get('cms/categories/{id}/delete', 'CategoriesController@destroy');

## Subcategories
Route::get('/categories/{category_id}/subcategories/{subcategory_id}', 'SubcategoriesController@show');
Route::get('cms/subcategories', 'SubcategoriesController@index');
Route::get('cms/subcategories/create', 'SubcategoriesController@create');
Route::post('cms/subcategories', 'SubcategoriesController@store');
Route::get('cms/subcategories/{id}/edit', 'SubcategoriesController@edit');
Route::post('cms/subcategories/{id}/update', 'SubcategoriesController@update');
Route::get('cms/subcategories/{id}/delete', 'SubcategoriesController@destroy');
