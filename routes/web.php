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

Route::get('/',[\App\Http\Controllers\HomeController::class, 'home'])->name('site.index');

Route::post('/filtro',[\App\Http\Controllers\HomeController::class, 'filtragem'])->name('site.filtro');



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/import-form', [App\Http\Controllers\DadosController::class, 'importForm']);

Route::post('/import', [App\Http\Controllers\HomeController::class, 'import'])->name('dados.import');

