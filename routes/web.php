<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

require __DIR__.'/shop.php';
require __DIR__.'/cart.php';
require __DIR__.'/checkout.php';
require __DIR__.'/pages.php';
require __DIR__.'/auth.php';
require __DIR__.'/account.php';
require __DIR__.'/admin.php';
