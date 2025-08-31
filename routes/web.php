<?php

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/books', [HomeController::class, 'books'])->name('books');

Route::get('/join/{qrCode}', [CommunityController::class, 'show'])->name('community.join');
Route::post('/join/{qrCode}', [CommunityController::class, 'store'])->name('community.register');

Route::get('/qr/print/{qrCode}', [CommunityController::class, 'printQr'])->name('qr.print');
Route::get('/qr/view/{qrCode}', [CommunityController::class, 'viewQr'])->name('qr.view');
