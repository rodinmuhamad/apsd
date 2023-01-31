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
    Route::get('/deleteuser', 'userController@destroy');
    Route::get('/akses', 'aksesController@index');
    Route::get('/tableakses', 'aksesController@table');
    Route::get('/getakses', 'aksesController@edit');
    Route::post('/akses', 'aksesController@store');
    Route::get('/deleteakses', 'aksesController@destroy');
});

Route::group(['middleware' => ['auth','ceklevel:admin,user']], function () {
    Route::get('/beranda', 'berandaController@index');
});