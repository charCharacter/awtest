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

Route::get('/form/create', [\App\Http\Controllers\FormController::class, 'create'])->name('form.create');
Route::get('/form/user/{id}', [\App\Http\Controllers\FormController::class, 'userForm'])->name('form.userForm');

Route::middleware( 'throttle:2,1', )
    ->middleware( 'email.throttle:2,1', )
    ->post('/form', [\App\Http\Controllers\FormController::class, 'store'])->name('form.store');
