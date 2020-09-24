<?php

    use Illuminate\Support\Facades\Route;

    Route::prefix('api')
         ->middleware('auth:api')
         ->group(static function ()
         {
         });
