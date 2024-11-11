<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['app.api'])->group(function () {
    Route::controller(App\Http\Controllers\API\NewsController::class)->group(function() {
        Route::get('categories', 'categories');
        Route::get('news', 'getCategoriesAndNews');
        Route::post('push-notification', 'push_notification')->name('notification.pushed');
    });

    Route::middleware(['app.auth'])->group(function () {
        // Additional routes that require authentication can go here.
    });
});


