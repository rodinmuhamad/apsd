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

Route::get('/', function () {
return view('welcome');
});

Route::post('/postLogin', 'loginController@postLogin')->name('postlogin');
Route::get('/login', 'loginController@index')->name('login');
Route::get('/registrasi', 'loginController@create')->name('registrasi');
Route::post('/postRegistrasi', 'loginController@store')->name('postregistrasi');
Route::get('/logout', 'loginController@logout')->name('logout');

Route::group(['middleware' => ['auth','ceklevel:admin']], function () {
    Route::get('/beranda', 'berandaController@index');
    Route::get('/user', 'userController@index');
    Route::get('/tableuser', 'userController@table');
    Route::get('/getuser', 'userController@edit');
    Route::post('/user', 'userController@store');
    Route::delete('/user', 'userController@delete');
});

Route::group(['middleware' => ['auth','ceklevel:admin,user']], function () {
    Route::get('/beranda', 'berandaController@index');
});