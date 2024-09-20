<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;

Route::controller(WebsiteController::class)->group(function () {
    Route::get('get-news/{news}', 'get_news')->name('news.show');
    Route::get('get-author', 'get_author')->name('author.show');
    Route::get('/', 'get_home')->name('home.get-home');
    Route::get('get-categories', 'get_categories')->name('category.show');
});
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/a', function () {
    return view('frontend.website.index');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    // Routes without 'system' prefix but require authentication

    // Prefix all 'system' routes
    Route::prefix('system')->group(function () {
        Route::get('home', [HomeController::class, 'index'])->name('home');
        Route::resource('categories', CategoryController::class);

        Route::controller(App\Http\Controllers\NewsController::class)->group(function () {
            Route::post('push-notification', 'push_notification')->name('notification.pushed');
        });

        Route::get('news', [NewsController::class, 'index'])->name('news.index');
        Route::get('news/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('news', [NewsController::class, 'store'])->name('news.store');
        Route::get('news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::put('news/{news}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

        Route::post('news/pushed', [App\Http\Controllers\Frontend\NewsController::class, 'pushed'])->name('news.pushed');

    });
    Route::controller(SettingController::class)->group(function () {
        Route::get('toggleTheme', 'toggleTheme')->name('setting.toggleTheme');
        Route::get('locale/{lang}', 'setLang')->name('change.locale');
        Route::post('toggleLang', 'toggleLang')->name('setting.toggleLang');
    });
});
