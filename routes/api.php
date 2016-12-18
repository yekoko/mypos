<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
Route::group(['prefix' => 'v1'], function(){
	Route::get('jobs','Api\ApiController@getJobs');
	Route::get('companies','Api\ApiController@getCompanies');
	Route::get('experiences','Api\ApiController@getExperiences');
	Route::get('categories','Api\ApiController@getCategories');
	Route::get('register','Admin\AdminController@getRegister');
	Route::post('register','Admin\AdminController@postRegister');
	Route::post('login','Admin\AdminController@postLogin');
	Route::post('user_experience','Api\ApiController@postUserexperience');
	Route::get('user_experience/{id}','Api\ApiController@getUserexperience');
	Route::get('industries','Api\ApiController@getIndustries');
	Route::post('user/{id}','Api\ApiController@editUser');
	Route::get('save_jobs/{id}','Api\ApiController@getSavedjobs');
	Route::post('save_jobs','Api\ApiController@postSavedjobs');
	Route::get('save_jobs_count/{id}','Api\ApiController@getSavedjobscount');
	Route::get('qualifications',"Api\ApiController@getQualification");
	Route::get('educations/{id}','Api\ApiController@getEducation');
	Route::post('educations','Api\ApiController@postEducation');
});
