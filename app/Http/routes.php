<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);

Route::get('auth/login', 'AuthController@getLogin');
Route::get('auth/logout', 'AuthController@getLogout');

//> Make sure user is signed in
Route::group(array('middleware' => 'auth'), function() {

	Route::get('/', function() {
		if(\Auth::user()->rank == 3)
			return Redirect::to('projects');
		else
			return Redirect::to('dashboard');
	});
	Route::get('projects', 'ProjectController@index');
	Route::get('account', 'AccountController@index');
	Route::get('account/edit', 'AccountController@edit');
	Route::post('account/edit', 'AccountController@update');
	Route::get('/help', 'HelpController@index');

	//>> Make sure user has at least SUPERADMINISTRATOR privileges
	Route::group(array('middleware' => 'superadmin'), function() {
		Route::get('users', 'UserController@index');
		Route::get('users/create', 'UserController@create');
		Route::post('users/create', 'UserController@store');
		Route::get('users/show/{id}', 'UserController@show');
		Route::get('users/edit/{id}', 'UserController@edit');
		Route::post('users/edit/{id}', 'UserController@update');
		Route::get('users/delete/{id}', 'UserController@delete');
		Route::get('projects/{client}/{stub}/issues/delete/{idlist}', 'IssueController@delete');
	});
    //>> Make sure user has at least ADMINISTRATOR priviliges
	Route::group(array('middleware' => 'admin'), function() {
		Route::get('dashboard', 'DashboardController@show');
		Route::get('clients', 'ClientController@index');
		Route::get('clients/show/{stub}', 'ClientController@show');
		Route::get('clients/create', 'ClientController@create');
		Route::post('clients/create', 'ClientController@store');
		Route::get('clients/edit/{id}', 'ClientController@edit');
		Route::post('clients/edit/{id}', 'ClientController@update');
		Route::get('clients/delete/{id}', 'ClientController@delete');
		Route::get('clients/show/{stub}/create', 'ProjectController@create');
		Route::post('clients/show/{stub}/create', 'ProjectController@store');
		Route::get('projects/{client}/{stub}/edit', 'ProjectController@edit');
		Route::post('projects/{client}/{stub}/edit', 'ProjectController@update');
	});

    //>> Make sure user has at least CLIENT priviliges
	Route::group(array('middleware' => 'client'), function() {
		Route::get('projects/{client}/{stub}', 'ProjectController@show');
		Route::get('projects/{client}/{stub}/issues', 'IssueController@index');
		Route::get('projects/{client}/{stub}/issues/print', 'IssueController@printout');
		Route::get('projects/{client}/{stub}/issues/filter/{filter}/print', 'IssueController@printout');
		Route::get('projects/{client}/{stub}/issues/filter/{filter}', 'IssueController@filter');
		Route::get('projects/{client}/{stub}/issues/create', 'IssueController@create');
		Route::post('projects/{client}/{stub}/issues/create', 'IssueController@store');
		Route::get('projects/{client}/{stub}/issues/edit/{id}', 'IssueController@edit');
		Route::post('projects/{client}/{stub}/issues/edit/{id}', 'IssueController@update');
		Route::get('projects/{client}/{stub}/issues/show/{id}', 'IssueController@show');
		Route::post('projects/{client}/{stub}/issues/show/{id}', 'IssueController@updateIssueHistory');
		Route::get('projects/{client}/{stub}/issues/show/{id}/resolve', 'IssueController@resolve');
		Route::get('projects/{client}/{stub}/issues/show/{id}/reopen', 'IssueController@reopen');
		Route::get('projects/{client}/{stub}/issues/show/{id}/close', 'IssueController@close');
        Route::get('projects/{client}/{stub}/uploads/{filename}', 'UploadController@show');

		Route::get('projects/{client}/{stub}/issues/claim/{idlist}', 'IssueController@claim');
		Route::get('projects/{client}/{stub}/issues/resolve/{idlist}', 'IssueController@resolve');

	});
});