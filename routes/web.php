<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\PaginatorController;
use \App\Http\Controllers\DaterangepickerController;

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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/paginator/{paginatortype?}/{param1?}/{param2?}', [PaginatorController::class, 'index'])->name('paginator');
Route::get('/daterangepicker/{type?}/{lang?}', [DaterangepickerController::class, 'index'])->name('daterangepicker');
