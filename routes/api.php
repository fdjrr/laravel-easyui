<?php

use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\MenuController;

Route::prefix('v1')->group(function () {
    Route::apiResource('users', UserController::class);

    Route::prefix('menu')->group(function () {
        Route::post('tree', [MenuController::class, 'tree'])->name('api.menu.tree');
    });
    Route::apiResource('menu', MenuController::class);
});
