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

Route::get('jobs','Api\ApiController@getJobs');
Route::get('companies','Api\ApiController@getCompanies');
Route::get('experiences','Api\ApiController@getExperiences');
Route::get('categories','Api\ApiController@getCategories');


Route::get('register','Admin\AdminController@getRegister');
Route::post('register','Admin\AdminController@postRegister');