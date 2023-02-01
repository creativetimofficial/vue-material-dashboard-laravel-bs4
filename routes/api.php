<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Permissions
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
});
Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::post('/clients', 'ClientsController@store')->name('client.store.api');
    Route::get('/clients/{client}', 'ClientsController@show')->name('client.show.api');
    Route::get('/clients', 'ClientsController@getClientsJson')->name('client.index.api');
    Route::delete('/clients/{client}', 'ClientsController@delete')->name('client.delete.api');
    Route::put('/clients/{client}', 'ClientsController@update')->name('client.update.api');
});