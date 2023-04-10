<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\PaginatorController;
use \App\Http\Controllers\DaterangepickerController;
use \App\Http\Controllers\TablebuilderController;
use \App\Http\Controllers\UploaderController;
use \App\Http\Controllers\AutocompleterController;
use \App\Http\Controllers\FileUploadController;
use \App\Http\Controllers\TagsinputController;
use \App\Http\Controllers\FormsbootstrapController;
use \App\Http\Controllers\MenuUtilsController;
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
Route::get('', [HomeController::class, 'index'])->name('home');
Route::get('/cv', [HomeController::class, 'cv'])->name('cv');
Route::get('/publis', [HomeController::class, 'publis'])->name('publis');
Route::get('/paginator/{paginatortype?}/{param1?}/{param2?}', [PaginatorController::class, 'index'])->name('paginator');
Route::get('/daterangepicker/{type?}/{lang?}', [DaterangepickerController::class, 'index'])->name('daterangepicker');
Route::get('/tablebuilder/{type?}', [TablebuilderController::class, 'index'])->name('tablebuilder');
Route::get('/uploader/{type?}', [UploaderController::class, 'index'])->name('uploader');
Route::get('/autocompleter/{type?}', [AutocompleterController::class, 'index'])->name('autocompleter');
Route::get('/formsbootstrap/{type?}', [FormsbootstrapController::class, 'index'])->name('formsbootstrap');
Route::get('/' . env('UPLOAD_DEL_URL'), [UploaderController::class, 'deleteFiles'])->name('deletefiles');
Route::get('/tagsinput/{type?}', [TagsinputController::class, 'index'])->name('tagsinput');
Route::get('/menuutils/{type?}', [MenuUtilsController::class, 'index'])->name('menuutils');
Route::get('/specialauth', [HomeController::class, 'specialauth'])->name('specialauth');

Route::post('/tablebuilder/loadtab', [TablebuilderController::class, 'loadTable'])->name('tableload');
Route::post('/tablebuilder/loadtab2', [TablebuilderController::class, 'loadTable2'])->name('tableload2');
Route::post('/fileupload2', [FileUploadController::class, 'processFile'])->name('fileupload2');
Route::post('/fileupload', [FileUploadController::class, 'index'])->name('fileupload');
Route::post('/deletefile', [FileUploadController::class, 'delete'])->name('filedelete');
Route::post('/autocompleter/search', [AutocompleterController::class, 'search'])->name('autocompletesearch');
Route::post('/tagsinput/search', [TagsinputController::class, 'search'])->name('tagsinputsearch');
Route::post('/tagsinput/addemployee', [TagsinputController::class, 'addEmployee'])->name('tagsinputaddemployee');
Route::post('/formsbootstrap/processform', [FormsbootstrapController::class, 'processform'])->name('formsbootstrap_processform');
Route::post('/formsbootstrap/filldata', [FormsbootstrapController::class, 'filldata'])->name('formsbootstrap_filldata');
Route::post('/formsbootstrap/checkoldpass', [FormsbootstrapController::class, 'checkoldpass'])->name('formsbootstrap_checkoldpass');

Route::redirect('/sebastien', '/');
