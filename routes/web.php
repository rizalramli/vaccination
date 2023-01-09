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
    return redirect()->route('home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::resource('history', 'App\Http\Controllers\HistoryController');
    Route::resource('kipi', 'App\Http\Controllers\KipiController');
    Route::resource('employee-vaccination', 'App\Http\Controllers\EmployeeVaccinationController');

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::post('vaccination/presence', 'App\Http\Controllers\VaccinationController@presence')->name('vaccination.presence');
    Route::resource('vaccination', 'App\Http\Controllers\VaccinationController');
    Route::resource('schedule', 'App\Http\Controllers\ScheduleController');

    Route::resource('employee', 'App\Http\Controllers\EmployeeController');
    Route::resource('vaccinator', 'App\Http\Controllers\VaccinatorController');
    Route::resource('vaccine-type', 'App\Http\Controllers\VaccineTypeController');

});
