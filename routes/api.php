<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ImageController;

Route::prefix('V1')->group(function () {
    Route::get('/images', [ImageController::class, 'getImagesInfo']);
    Route::get('/images/{id}', [ImageController::class, 'findImage']);
    Route::post('/upload/images/', [ImageController::class, 'create']);
    Route::get('/download/images/{imageId}', [ImageController::class, 'download']);
});