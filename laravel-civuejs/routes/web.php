<?php

use Illuminate\Support\Facades\Route;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Users_new;
use App\Http\Controllers\UserController;

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
//     return view('app');
// });

Route::get('{any}', function () {
    return view('layouts.app');
})->where('any', '.*');

Route::post('get-users','UserController@index')->name('get-users');
Route::post('search-users','UserController@search')->name('search-users');
Route::post('add-user','UserController@store')->name('add-user');
Route::post('edit/update-user','UserController@update')->name('update-user');
Route::post('edit/get-user-by-id','UserController@getUserById')->name('update-user');
Route::post('delete-user','UserController@destroy')->name('delete-user');
Route::get('show-user/{id}','UserController@show')->name('show-user');