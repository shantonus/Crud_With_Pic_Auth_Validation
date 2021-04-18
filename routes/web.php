<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\GuestController;

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


Auth::routes();

Route::get('/', [MyController::class, 'main'])->name('main');
Route::get('/home', [MyController::class, 'dashboard'])->name('dashboard');

//Add Data
Route::post('/add', [MyController::class, 'insert']);

Route::get('/view/{id}', [MyController::class, 'view']);

Route::get('/edit/{id}', [MyController::class, 'edit']);
Route::post('/edit_success/{id}', [MyController::class, 'edit_success']);

Route::get('/delete/{id}', [MyController::class, 'delete']);

Route::get('/change_password', [MyController::class, 'changePass']);
Route::post('/change_password_success', [MyController::class, 'changePassSuccess'])->name('change.pass');
