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

/*Route::get('/', function () {
return view('welcome');
});*/

Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::resource('/write', 'PostController');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });
});

Route::resource('/', 'HomeController');
Route::resource('/technology', 'TechnologyController');
Route::resource('/entertainment', 'EntertainmentController');
Route::resource('/lifestyle', 'LifestyleController');
Route::resource('/food', 'FoodController');
Route::resource('/sport', 'SportController');
