<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::view('/', 'store.checkout.index')->name('index');
Route::view('/confirmation', 'store.checkout.confirmation')->name('confirmation');
