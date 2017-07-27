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

use Illuminate\Support\Facades\Hash;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/hash/{plain}', function ($plain) {
    return Hash::make($plain);
});

Route::get('/hash/check/{plain}', function ($plain) {
	$hashed = '$2y$10$L9dPa1QQBPJJLmfoOubQXOLCf9Qa/HeIb6E1KT/cDadYkg.ak9Wsm';
    return Hash::check($plain, $hashed) ? 1 : 0;
});


/*
 * Default authentication routes
 */
Auth::routes();

/*
 * Admin authentication routes
 */
Route::group(['prefix' => 'admin'], function() {
  Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
  Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');
  Route::get('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
  
  Route::get('register', 'Admin\Auth\RegisterController@showRegisterForm')->name('admin.register');
  Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin.register');
 
  Route::get('home', 'Admin\HomeController@index')->name('admin.home');
});
 

Route::get('/home', 'HomeController@index')->name('home');
