<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserController as UserV1;
use App\Http\Controllers\API\V2\UserController as UserV2;

Route::prefix('v1')->group(function () {
    Route::get('/users', [UserV1::class, 'index']);
});

Route::prefix('v2')->group(function () {
    Route::get('/users', [UserV2::class, 'index']);
});

Route::get('/users', function (\Illuminate\Http\Request $request) {
    $version = $request->query('version', '1'); 

    if ($version == '2') {
        return app(UserV2::class)->index();
    }
    
    return app(UserV1::class)->index();
});
