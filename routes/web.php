<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EncontristasController;
use Illuminate\Support\Facades\Route; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Controller::class, 'index']);

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'store'])->name('store');
Route::get('/sair', [LoginController::class, 'destroy'])->name('sair');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showRequestForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

Route::controller(HomeController::class)->prefix('home')->name('home.')->middleware('auth')->group(function(){
    Route::get('/index', 'index')->name('index');
});

Route::controller(UsersController::class)->prefix('users')->name('users.')->middleware('auth')->group(function(){
    Route::get('/index', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');  
    Route::get('/edit/{user}', 'edit')->name('edit');
    Route::delete('/{user}', 'destroy')->name('destroy')->middleware('can:excluir-registro');  
    Route::put('/{user}', 'update')->name('update');
    Route::post('/{user}', 'alterarSenha')->name('alterarSenha');
});

Route::controller(EncontristasController::class)->prefix('encontristas')->name('encontristas.')->middleware('auth')->group(function(){
    Route::get('/index', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');  
    Route::get('/edit/{encontrista}', 'edit')->name('edit');
    Route::get('/ficha/{encontrista}', 'ficha')->name('ficha');
    Route::delete('/{encontrista}', 'destroy')->name('destroy')->middleware('can:excluir-registro');  
    Route::put('/{encontrista}', 'update')->name('update');
    Route::get('/gerarCsv', 'gerarCsv')->name('gerarCsv');
    Route::get('/gerarAllFichas', 'gerarAllFichas')->name('gerarAllFichas');
});