<?php

use App\Http\Controllers\Api\ThemeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource("/theme", ThemeController::class)->only([
    "index",
]);