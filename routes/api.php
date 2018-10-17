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
Route::get('admin/api/usersbyname', 'API\UserController@usersByName');
Route::get('admin/api/usersbytype', 'API\UserController@usersByType');

Route::apiResources ([
  'admin/api/console' => 'ConsoleController'
]);
Route::get('admin/api/profile', 'API\UserController@profile');
Route::put('admin/api/profile', 'API\UserController@updateProfile');


Route::get('admin/api/categories', 'CategoryController@index');
// LIST SINGLE ARTICLE
Route::get('admin/api/category/{id}', 'CategoryController@show');
// CREATE NEW ARTICLEcategory
Route::post('admin/api/category', 'CategoryController@store');
// UPDATE ARTICLE
Route::put('admin/api/category', 'CategoryController@store');
// UPDATE ARTICLE
Route::delete('admin/api/category/{id}', 'CategoryController@destroy');

