<?php

use App\Http\Controllers\PessoaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pessoas',[PessoaController::class,'index'])->name('pessoas.index');
Route::get('/{id}/pessoa',[PessoaController::class,'show'])->name('pessoas.show');
Route::post('/pessoas/store', [PessoaController::class, 'store'])->name('pessoas.store');
Route::put('/{id}/pessoa/update',[PessoaController::class,'update'])->name('pessoas.update');
Route::delete('/{id}/pessoa/delete',[PessoaController::class,'delete'])->name('pessoas.delete');