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

Route::get('search/{searchTerm}/{location?}', 'HomeController@search');
Route::get('getAllJobs', 'HomeController@getAllJobs');

Route::get('getpreferences/{email}', 'HomeController@getpreferences');

Route::get('getfeed/{email}', 'HomeController@getfeed');

Route::get('jobdetails/{id}', 'HomeController@jobdetails');
Route::get('adduser/{personName}/{email}/{personPhotoUrl}/{personGooglePlusProfile}',array('as' => '', 'uses' => 'HomeController@adduser'));
Route::resource('adduser', 'HomeController');

Route::get('addpreferences/{location}/{email}/{major}/{jobcategory}',array('as' => 'a', 'uses' => 'HomeController@addpreferences'));
Route::resource('addpreferences', 'HomeController');



Route::get('getUserJobs/{email}', 'HomeController@getUserJobs');

//Route::get('jobs', function()
//{
//	return View::make('jobs');	
//});


//Route::get('jobdetails', function()
//{
//	return View::make('jobdetails');
//});


//Route::get('users', function()
//{
//	return View::make('users');
//});

Route::get('/', function()
{
	return View::make('hello');
});
/*
Route::get('jobdetails/{id}', function($id)
{
  return DbHandler::getJobDetails($id);
});
Route::get('jobdetails/{id}', 'DbHandler@getJobDetails');
Route::get('user/{id}', function($id)
{

return 'DbHandler@getJobDetails' ;	
   // return 'User '.$id;
});

?*/