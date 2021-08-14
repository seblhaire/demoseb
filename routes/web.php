<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\PaginatorController;
use \App\Http\Controllers\DaterangepickerController;
use \App\Http\Controllers\TablebuilderController;
use \App\Http\Controllers\UploaderController;
use \App\Http\Controllers\AutocompleterController;
use Seblhaire\Uploader\FileuploadController;
use \App\Http\Controllers\TagsinputController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cv', [HomeController::class, 'cv'])->name('cv');
Route::get('/publis', [HomeController::class, 'publis'])->name('publis');
Route::get('/paginator/{paginatortype?}/{param1?}/{param2?}', [PaginatorController::class, 'index'])->name('paginator');
Route::get('/daterangepicker/{type?}/{lang?}', [DaterangepickerController::class, 'index'])->name('daterangepicker');
Route::get('/tablebuilder', [TablebuilderController::class, 'index'])->name('tablebuilder');
Route::get('/uploader', [UploaderController::class, 'index'])->name('uploader');
Route::get('/autocompleter', [AutocompleterController::class, 'index'])->name('autocompleter');
Route::get('/' . env('UPLOAD_DEL_URL'), [UploaderController::class, 'deleteFiles'])->name('uploader');
Route::get('/tagsinput', [TagsinputController::class, 'index'])->name('tagsinput');


Route::post('/tablebuilder/loadtab', [TablebuilderController::class, 'loadTable'])->name('tableload');
Route::post('/tablebuilder/loadtab2', [TablebuilderController::class, 'loadTable2'])->name('tableload2');
Route::post('/processfile', [UploaderController::class, 'processFile'])->name('processfile');
Route::post('/fileupload', [FileuploadController::class, 'index'])->name('fileupload');
Route::post('/autocompleter/search', [AutocompleterController::class, 'search'])->name('autocompletesearch');
Route::post('/tagsinput/search', [TagsinputController::class, 'search'])->name('tagsinputsearch');
Route::post('/tagsinput/addemployee', [TagsinputController::class, 'addEmployee'])->name('tagsinputaddemployee');
Route::get('/refresh-csrf', function(){
    return csrf_token();
})->name('refreshcsrf');

Route::redirect('/sebastien', '/');
