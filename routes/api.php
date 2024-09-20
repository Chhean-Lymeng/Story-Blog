<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'app.api', 'prefix' => 'v1'], function () {
   
    Route::controller(App\Http\Controllers\NewsController::class)->group(function() {
        Route::get('categories', 'categories');
        Route::get('news', 'news');
        Route::post('push-notification', 'push_notification')->name('notification.pushed');
    });

    Route::group(['middleware' => 'app.auth'], function () {

    });
}); 

