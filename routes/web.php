<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@homepage');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

Auth::routes();

Route::prefix('admin')->middleware('can:isAdmin')->group(function(){
// Route::prefix('admin')->group(function(){
Route::get('/', 'HomeController@index')->name('admin.dashboard');
Route::get('/dashboard', 'HomeController@index')->name('admin.dashboard');
Route::get('/api', 'HomeController@api')->name('admin.api');
Route::get('/categories', 'AdminController@categories')->name('admin.categories');
Route::get('/user', 'AdminController@users')->name('admin.users');
Route::get('/developer', 'AdminController@developer')->name('admin.developer');
Route::get('/profile', 'AdminController@profile')->name('admin.profile');


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
