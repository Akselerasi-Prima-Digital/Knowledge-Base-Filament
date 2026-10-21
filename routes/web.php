<?php

use App\Http\Controllers\MainPageController;
use Illuminate\Support\Facades\Route;

Route::controller(MainPageController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/cari', 'search')->name('home.search');
    Route::get('/kategori/{category:slug}/', 'category')->name('home.category');
    Route::get('/tag/{tag:slug}/', 'tag')->name('home.tag');
    Route::get('/artikel/{article:slug}/', 'article')->name('home.article');
});
