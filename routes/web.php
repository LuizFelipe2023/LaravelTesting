<?php

use App\Http\Controllers\PessoaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',function(){
      return view('dashboard');
})->name('dashboard');

Route::get('/pessoas',[PessoaController::class,'index'])->name('pessoas.index');
Route::get('/{id}/pessoa',[PessoaController::class,'show'])->name('pessoas.show');
Route::post('/pessoas/store', [PessoaController::class, 'store'])->name('pessoas.store');
Route::put('/{id}/pessoa/update',[PessoaController::class,'update'])->name('pessoas.update');
Route::delete('/{id}/pessoa/delete',[PessoaController::class,'delete'])->name('pessoas.delete');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::put('/{id}/update',[AuthController::class,'updatePassword'])->name('auth.update');

