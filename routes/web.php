<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    Route::resource('permissions', App\Http\Controllers\Auth\PermissionController::class);
    Route::resource('roles', App\Http\Controllers\Auth\RoleController::class);
    Route::resource('users', App\Http\Controllers\Auth\UserController::class);
    Route::get('/profile', [App\Http\Controllers\Auth\UserController::class, 'profile'])->name('update.profile');
    Route::post('update-profile/{id}', [App\Http\Controllers\Auth\UserController::class, 'update_profile'])->name('update-profile');
    Route::prefix('system')->group(function () {
        Route::get('home', [HomeController::class, 'index'])->name('home');
        Route::resource('categories', CategoryController::class);
        Route::get('news', [NewsController::class, 'index'])->name('news.index');
        Route::get('news/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('news', [NewsController::class, 'store'])->name('news.store');
        Route::get('news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::put('news/{news}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

    });
        Route::controller(App\Http\Controllers\NewsController::class)->group(function () {
            Route::post('push-notification', 'push_notification')->name('notification.pushed');


        Route::post('news/pushed', [App\Http\Controllers\NewsController::class, 'pushed'])->name('news.pushed');

    });
    Route::controller(SettingController::class)->group(function () {
        Route::get('toggleTheme', 'toggleTheme')->name('setting.toggleTheme');
        Route::get('locale/{lang}', 'setLang')->name('change.locale');
        Route::post('toggleLang', 'toggleLang')->name('setting.toggleLang');
    });
});
