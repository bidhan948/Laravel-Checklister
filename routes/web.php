<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware'=>'auth'],function(){
    Route::group(['prefix'=>'admin', 'as'=>'admin.', 'middleware'=>'is_admin'],function(){
        Route::resource('pages',App\Http\Controllers\Admin\PageController::class);
        Route::resource('checklist_groups.checklists',App\Http\Controllers\Admin\checklistController::class);
        Route::resource('checklist_groups',App\Http\Controllers\Admin\checklistGroupController::class);
    });
});
