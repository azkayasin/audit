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
    return view('auth.login');
});

Auth::routes();

Route::get("addmore","temuanController@addMore");
Route::post("addmore","temuanController@addMorePost");
Route::get("tambah","temuanController@tambah");
Route::post("tambah","temuanController@tambahpost");
Route::post("tambahkda","temuanController@tambahkda");

Route::post('/get/child', 'admincontroller@getChild');
Route::get('/tables', 'admincontroller@tables');

Route::get('pdf/{id}',  'temuanController@buatpdf');
Route::get('/kda', 'kdacontroller@index');
Route::get('/pilihkda', 'kdacontroller@pilih');
Route::get('pilihkda/{id}', 'kdacontroller@formkda');


Route::get('/login', 'AuthController@showLogin')->name('login')->middleware('guest');
Route::post('/login', 'AuthController@login');
// Route::get('/register', 'AuthController@showRegister')->name('register')->middleware('guest');
// Route::post('/register', 'AuthController@register');
Route::post('/logout', 'AuthController@logout')->name('logout');
Route::get('/hak','AuthController@hak')->name('hak');
Route::group(['middleware' => 'admin'], function () {
	Route::get('/admin','AuthController@home')->name('home1');
	Route::get('/dashboard','AuthController@dashboard')->name('dashboard');
	Route::get('/data','admincontroller@datamaster')->name('datamaster');
	Route::get('/uang','admincontroller@uang')->name('uang');
});

Route::group(['middleware' => 'member'], function () {
	Route::get('/member','AuthController@homemember')->name('home2');
});
