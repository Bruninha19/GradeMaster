<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAccountController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/criarConta', function () {
    return view('criarConta'); // Aponta para uma view Blade chamada 'register.blade.php'
});