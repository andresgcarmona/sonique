<?php

    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\Auth\LoginUserController;
    use App\Http\Controllers\IndexController;
    use Illuminate\Support\Facades\Route;

    Route::get('/', IndexController::class)->name('index');

    Route::get('login', LoginController::class)->name('login');
    Route::post('login', LoginUserController::class)->name('login.user');

