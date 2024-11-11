<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(App\Http\Controllers\API\NewsController::class)->group(function () {
    Route::get('categories', 'categories');
    Route::get('news', 'getCategoriesAndNews');
    Route::get('user-news', 'getUserNews');
    Route::get('single-news', 'getSingleNews');
    Route::get('breaking-news', 'getBreakingNews');
    Route::get('search-news', 'searchNews');    
    Route::post('push-notification', 'push_notification')->name('notification.pushed');
});
