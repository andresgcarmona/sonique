<?php

    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\Auth\LoginUserController;
    use App\Http\Controllers\Auth\LogoutUserController;
    use App\Http\Controllers\Auth\SpotifyCallbackAuthController;
    use App\Http\Controllers\IndexController;
    use Illuminate\Support\Facades\Route;

    Route::get('/', IndexController::class)->name('index');

    Route::get('login', LoginController::class)->name('login');
    Route::get('callback', SpotifyCallbackAuthController::class)->name('spotify.callback');
    Route::get('logout', LogoutUserController::class)->name('logout');
    Route::post('login', LoginUserController::class)->name('login.user');

    Route::get('{any?}', IndexController::class)->name('index')->where('any', '.*');

