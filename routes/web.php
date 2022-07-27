<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SenderController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('documents',DocumentController::class);
Route::resource('files',FileController::class)->only('destroy');
Route::resource('companies',CompanyController::class)->only(['create','edit','index','store','update']);
Route::resource('departments',DepartmentController::class)->except(['destroy','show']);
Route::resource('positions',PositionController::class)->except(['destroy','show']);
Route::resource('senders',SenderController::class)->except(['destroy','show']);
Route::resource('tags',TagController::class)->except(['destroy','show']);
