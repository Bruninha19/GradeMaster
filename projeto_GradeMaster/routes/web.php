<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAccountController;

Route::resource('contas', UserAccountController::class);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/criarConta', function () {
    return view('criarConta'); // Aponta para uma view Blade chamada 'register.blade.php'
})->name('criarConta.show');