<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::view('/', 'store.products.index')->name('index');

Route::get('{slug}', function (string $slug) {
    return view('store.products.show', ['slug' => $slug]);
})->name('show');
