<?php

use Illuminate\Support\Facades\Route;

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

Route::group([
    'namespace' => '\App\Http\Controllers'
], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/sharelink', 'IndexController@shareLink');
    Route::get('/link', 'IndexController@link');
    Route::post('/openlink', 'IndexController@openlink');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
