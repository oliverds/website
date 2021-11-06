<?php

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\ResetPassword;
use Illuminate\Support\Facades\Route;

Route::get('/mito/login', Login::class)->middleware(['web', 'guest'])->name('mito.auth.login');
Route::get('/mito/forgot-password', ForgotPassword::class)->middleware(['web', 'guest'])->name('mito.password.request');
Route::get('/mito/reset-password/{token}', ResetPassword::class)->middleware(['web', 'guest'])->name('mito.password.reset');
