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
    Route::get('/client', 'ClientsController@index');
    Route::get('/client/dataTable', 'ClientsController@getClients');
 });
