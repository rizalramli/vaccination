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
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::resource('schedule', 'App\Http\Controllers\ScheduleController');

Route::resource('employee', 'App\Http\Controllers\EmployeeController');
Route::resource('vaccinator', 'App\Http\Controllers\VaccinatorController');
Route::resource('vaccine-type', 'App\Http\Controllers\VaccineTypeController');
