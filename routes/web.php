<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('ph', function () {
    return bcrypt('naruton5');
});

Route::group(['prefix' => 'admin'], function () {
	 
 
    Route::get('register',['as' => 'register', 'uses' => 'Admin\AdminController@getRegister']);
    Route::post('register','Admin\AdminController@postRegister');
    Route::get('login',['as' => 'login', 'uses' => 'Admin\AdminController@getLogin']);
    Route::post('login','Admin\AdminController@postSignin');
    Route::get('logout',['as' => 'logout', 'uses' => 'Admin\AdminController@getLogout']);

    //Route::get('forgot-password',['as' => 'forgot-password', 'uses' => 'Admin\AdminController@getForgotpassword']);
    Route::post('forgot-password',['as' => 'forgot-password', 'uses' => 'Admin\AdminController@postForgotpassword']);

    Route::get('forgot-password-confirm/{userId}/{passwordResetCode}',['as' => 'forgot-password-confirm', 'uses' => 'Admin\AdminController@getForgotpasswordconfirm']);
    Route::post('forgot-password-confirm/{userId}/{passwordResetCode}','Admin\AdminController@postForgotpasswordconfirm');
     
	//Route::get('',['as' => 'dashboard', 'uses' =>'Admin\HomeController@getIndex']);
	

	Route::group(['middleware' => ['sentinel.admin']], function () {
		Route::get('/dashboard', ['as' => 'dashboard','uses' => 'Admin\HomeController@getIndex']);
		Route::group(['middleware' => ['role.admin']], function () {
			/* for user */
			Route::resource('language','Admin\LanguageController');
			Route::resource('user','Admin\UserController');
			Route::resource('role','Admin\RoleController');
			Route::resource('category','Admin\CategoryController');
			Route::resource('experience','Admin\ExperienceController');
			Route::resource('job','Admin\JobController');
			Route::resource('company','Admin\CompanyController');
			Route::resource('industry','Admin\IndustryController');
		});

		 


	}); 
	
});
