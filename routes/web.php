<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\GalleryCntroller;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('/load_images', [ImageController::class, 'create'])->name('image.create');
Route::get('/download/{imageId}', [ImageController::class, 'download'])->name('image.download');
Route::get('/gallery', [GalleryCntroller::class, 'index'])->name('gallery.index');