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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->group(function(){


});
Route::apiResources ([
  'admin/api/user' => 'API\UserController'
]);


Route::get('admin/api/categories', 'CategoryController@index');
// LIST SINGLE ARTICLE
Route::get('admin/api/category/{id}', 'CategoryController@show');
// CREATE NEW ARTICLEcategory
Route::post('admin/api/category', 'CategoryController@store');
// UPDATE ARTICLE
Route::put('admin/api/category', 'CategoryController@store');
// UPDATE ARTICLE
Route::delete('admin/api/category/{id}', 'CategoryController@destroy');

Route::group(['middleware' => 'can:isAdmin'], function () {
  // Route::get('api/categories', 'CategoryController@index')->middleware('can:isAdmin');
  // // LIST SINGLE ARTICLE
  // Route::get('api/category/{id}', 'CategoryController@show')->middleware('can:isAdmin');
  // // CREATE NEW ARTICLEcategory
  // Route::post('api/category', 'CategoryController@store');
  // // UPDATE ARTICLE
  // Route::put('api/category', 'CategoryController@store');
  // // UPDATE ARTICLE
  // Route::delete('api/category/{id}', 'CategoryController@destroy');
});
