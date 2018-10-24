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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('advertisements', 'AdvertisementController')->middleware('auth');

Route::get('render/{id}', 'RenderController@show');
Route::get('collects/view/{id}', 'CollectController@view');
Route::get('collects/click/{id}', 'CollectController@click');
