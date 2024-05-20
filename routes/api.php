<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ImageController;

Route::prefix('V1')->group(function () {
    Route::get('/getImagesInfo', [ImageController::class, 'getImagesInfo']);
    Route::get('/findImage/{id}', [ImageController::class, 'findImage']);
});