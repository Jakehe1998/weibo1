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

/* 静态页面 */
Route::get('/','StaticPagesController@home')->name('home');

Route::get('/help','StaticPagesController@help')->name('help');

Route::get('/about','StaticPagesController@about')->name('about');

/* 注册页面 */
Route::get('/signup','UsersController@create')->name('signup');

/* 用户资源路由 */
Route::resource('users','UsersController');
/*
resource方法接受两个参数，第一个参数为资源名称，第二个参数为控制器名称，上面代码等同于：

Route::get('/users','UsersController@index')->name('users.index');
Route::get('/users/create','UsersController@create')->name('users.create');
Route::get('/users/{user}','UsersController@show')->name('users.show');
Route::post('/users','UsersController@store')->name('users.store');
Route::get('/users/{user}/edit','UsersController@edit')->name('users.edit');
Route::patch('/users/{user}','UsersController@update')->name('users.update');
Route::delete('/users/{user}','UsersController@destory')->name('users.destory');

*/

/* 会话路由 */
Route::get('login','SessionsController@create')->name('login');

Route::post('login','SessionsController@store')->name('login');

Route::delete('/logout','SessionsController@destroy')->name('logout');

