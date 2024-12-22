<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('user', UserController::class);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('profile', [ProfileController::class, 'index'])->name('user.profile');

Route::get('docs', [DocsController::class, 'index'])->name('docs');

