<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Input;
use App\Models\Users_new;
// 
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//
// Route::middleware('api')->group(function(){
//     Route::resource('users_news',UserController::class);
// });

Route::post('/register', 'UserController@store');
Route::get('/get-users','UserController@index');

// Route::post('/auth/login', 'AuthController@login',[
//     'headers' => [
//         'Authorization' => 'Bearer '.$token,
//         'Accept' => 'application/json',
//     ],
// ]);
 
Route::post('/login', 'AuthController@login');

Route::group(['prefix' => 'api','middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function(Request $request) {
        return $request()->user();
    });

    Route::get('/logout', 'AuthController@logout');
});

