<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoriesController;

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
    Route::post('/categories', 'CategoriesController@store')->name('categories.store.api');
    Route::get('/categories/{category}', 'CategoriesController@show')->name('categories.show.api');
    Route::get('/categories', 'CategoriesController@getCategoriesJson')->name('categories.index.api');
    Route::put('/categories/{category}', 'CategoriesController@update')->name('categories.update.api');
    Route::delete('/categories/{category}', 'CategoriesController@delete')->name('categories.delete.api');


    Route::post('/brands', 'BrandsController@store')->name('brands.store.api');
    Route::get('/brands/{brand}', 'BrandsController@show')->name('brands.show.api');
    Route::get('/brands', 'BrandsController@getbrandsJson')->name('brands.index.api');
    Route::put('/brands/{brand}', 'BrandsController@update')->name('brands.update.api');
    Route::delete('/brands/{brand}', 'BrandsController@delete')->name('brands.delete.api');
    
    
    Route::post('/clients', 'ClientsController@store')->name('client.store.api');
    Route::get('/clients/{client}', 'ClientsController@show')->name('client.show.api');
    Route::get('/clients', 'ClientsController@getClientsJson')->name('client.index.api');
    Route::put('/clients/{client}', 'ClientsController@update')->name('client.update.api');
    Route::delete('/clients/{client}', 'ClientsController@delete')->name('client.delete.api');
});