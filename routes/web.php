<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'welcome');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/welcome', [App\Http\Controllers\pageController::class, 'welcome'])->name(('welcome'));
    Route::get('/consultation', [App\Http\Controllers\pageController::class, 'consultation'])->name(('consultation'));
    Route::get('checklist/{checklist}', [App\Http\Controllers\User\checklistController::class, 'show'])->name(('users.checklist.show'));
    // admin authentication
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is_admin'], function () {
        Route::resource('pages', App\Http\Controllers\Admin\PageController::class)->only(['edit','update']);
        Route::resource('checklist_groups.checklists', App\Http\Controllers\Admin\checklistController::class);
        Route::resource('checklist_groups', App\Http\Controllers\Admin\checklistGroupController::class);
        Route::resource('checklists.tasks', App\Http\Controllers\Admin\TaskController::class);
        Route::get('User', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    });
});
