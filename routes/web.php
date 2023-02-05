<?php
use App\Http\Controllers\CurrencyController;
use App\Exports\OccupationExport;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\AccommodationTableExport;
use App\Http\Controllers\ExportSturFile;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\OccupationCsv;
use App\Http\Controllers\OccupationTableController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\RateErrorReportController;
use App\Http\Controllers\PartnerMarkupController;
use App\Http\Controllers\ReservationGiftCardsController;
use App\Http\Controllers\SturXmlController;
use Spatie\laravelactivityLog\src\Models\Activity;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CalculatorTariffController;
use App\Http\Controllers\ReservationRelatoryController;
use App\Http\Controllers\ReservationSource;
use App\Http\Controllers\TemplateCsvController;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('dashboard.index');


Route::group(['middleware' => 'auth'], function () {
    //User Routes
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::resource('roles', 'RoleController');

    //Client Routes
    Route::get('/clients', 'ClientsController@index');
    Route::get('/clients/dataTable', 'ClientsController@getClients');

    // Categories Routes
    Route::post('/categories', 'CategoriesController@store');
    Route::get('/categories', 'CategoriesController@index');
    Route::get('/categories/dataTable', 'CategoriesController@getCategories');
    Route::get('/categories/{category}', 'CategoriesController@edit');
    Route::get('/categories/create', 'CategoriesController@create');
    Route::put('/categories/{category}', 'CategoriesController@update');
    Route::delete('/categories/{category}', 'CategoriesController@delete');


    // Brands Routes
    Route::get('/brands/create', 'BrandsController@create');
    Route::post('/brands', 'BrandsController@store');
    Route::get('/brands', 'BrandsController@index');
    Route::get('/brands/dataTable', 'BrandsController@getbrands');
    Route::get('/brands/{brand}', 'BrandsController@edit');
    Route::put('/brands/{brand}', 'BrandsController@update');
    Route::delete('/brands/{brand}', 'BrandsController@delete');
 });
