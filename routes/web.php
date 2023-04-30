<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Example Routes


Route::get('/',function (){
    return view('ui');
});
Auth::routes();

Route::middleware(['auth', 'role:admin|editor'])->group(function () {
    Route::resource('news',\App\Http\Controllers\Backend\NewsController::class);
    Route::resource('author',\App\Http\Controllers\Backend\AuthorController::class);
    Route::resource('users',\App\Http\Controllers\Backend\UserController::class);
    Route::resource('roles',\App\Http\Controllers\Backend\RoleController::class);
    Route::resource('news-category',\App\Http\Controllers\Backend\NewsCategoryController::class);
    Route::resource('leauge',\App\Http\Controllers\Backend\LeaugeController::class);
    Route::resource('players',\App\Http\Controllers\Backend\PlayerController::class);
    Route::resource('teams',\App\Http\Controllers\Backend\TeamsController::class);
    Route::resource('match',\App\Http\Controllers\Backend\MatchesController::class);
    Route::get('viewProfile',[\App\Http\Controllers\Backend\DashboardController::class,'viewProfile'])->name('profile');
    Route::get('editProfile/{id}',[\App\Http\Controllers\Backend\DashboardController::class,'editProfile'])->name('editProfile');
    Route::match(['get', 'post'], '/dashboard', function(){
        return view('dashboard');
    });

});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

