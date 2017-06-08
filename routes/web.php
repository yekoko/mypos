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
     return redirect()->route('login');
	//return view('sale');
});
 
Route::post('searchitem',['as' => 'searchitem','uses' => 'Admin\SaleController@searchitem']);
Route::get('searchitembyid/{id}',['as' => 'searchitembyid','uses' => 'Admin\SaleController@searchitembyid']);
Route::get('cartitem',['as' => 'cartitem','uses' => 'Admin\SaleController@cartitem']);
Route::put('editqty/{id}',['as' => 'editqty','uses' => 'Admin\SaleController@editqty']);
Route::delete('deletesale',['as' => 'deletesale','uses' => 'Admin\SaleController@deletesale']);
Route::delete('deletesalebyid/{id}',['as' => 'deletesalebyid','uses' => 'Admin\SaleController@deletesalebyid']);


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
	
    Route::resource('job','Admin\JobController');
	Route::group(['middleware' => ['sentinel.admin']], function () {
		Route::get('/dashboard', ['as' => 'dashboard','uses' => 'Admin\HomeController@getIndex']);
		Route::group(['middleware' => ['role.admin']], function () {

			Route::resource('user','Admin\UserController');
			Route::resource('role','Admin\RoleController'); 
			Route::get('sale',['as' => 'sale','uses' => 'Admin\SaleController@sale']);
			Route::resource('item','Admin\ItemController');
			Route::post('completesale',['as' => 'completesale','uses' => 'Admin\SaleController@completesale']);

		});

		 


	}); 
	
});
