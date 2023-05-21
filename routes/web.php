<?php

use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LeaugeController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\MatchesController;
use App\Http\Controllers\Backend\NewsCategoryController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\PlayerController;
use App\Http\Controllers\Backend\PlayerStatsController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\TeamsController;
use App\Http\Controllers\Backend\UserController;
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
    Route::resource('news', NewsController::class);
    Route::resource('author', AuthorController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('news-category', NewsCategoryController::class);
    Route::resource('leauge', LeaugeController::class);
    Route::resource('players', PlayerController::class);
    Route::resource('teams', TeamsController::class);
    Route::resource('match', MatchesController::class);
    Route::get('viewProfile',[DashboardController::class,'viewProfile'])->name('profile');
    Route::get('editProfile/{id}',[DashboardController::class,'editProfile'])->name('editProfile');
    Route::put('updateUser/{id}',[DashboardController::class,'updateUser'])->name('updateUser');;
    Route::resource('playerstats', PlayerStatsController::class);
    Route::get('admin',[DashboardController::class,'getDashBoard']);
    Route::get('dashboard',[DashboardController::class,'getDashBoard']);
    Route::get('performLogout',[DashboardController::class,'performLogout'])->name('admin-logout');
});
Route::get('/{any}', function () {
    return view('ui');
})->where('any', '.*');

Route::get('/auth/facebook', [LoginController::class,'redirectToFacebook']);
Route::get('/auth/facebook/callback',[LoginController::class,'handleFacebookCallback']);
Route::get('/auth/google', [LoginController::class,'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class,'handleGoogleCallback']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
