<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::apiResource('products', 'API\V1\ProductAPIController')
        ->except('show');

    Route::apiResource('categories', 'API\V1\CategoryAPIController')
        ->except(['index', 'show', 'update']);
});
