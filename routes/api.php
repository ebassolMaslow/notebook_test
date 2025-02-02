<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SketchpadController;

Route::prefix('v1')->group(function () {
    Route::apiResource('sketchpads', SketchpadController::class);
});