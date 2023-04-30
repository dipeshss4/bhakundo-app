<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('getTrendingNews',[\App\Http\Controllers\FrontendNewsController::class,'getTrendingNews']);
Route::post('uploadNewsImage',[\App\Http\Controllers\Backend\ImageController::class,'uploadImage']);
Route::get('getAllNews',[\App\Http\Controllers\FrontendNewsController::class,'getAllNews']);
Route::get('getNews/{id}',[\App\Http\Controllers\FrontendNewsController::class,'getNews']);
Route::get('getRecommendedNews',[\App\Http\Controllers\FrontendNewsController::class,'getRecommendNews']);
Route::get('newsCategory',[\App\Http\Controllers\FrontendNewsController::class,'getNewsCategory']);
Route::get('getAllTeams',[\App\Http\Controllers\RestTeamController::class,'getAllTeams']);
Route::get('getAllLeague',[\App\Http\Controllers\RestLeagueController::class,'getAllLeague']);
Route::get('getLeague/{id}',[\App\Http\Controllers\RestLeagueController::class,'getLeague']);
Route::get('getTeams/{id}',[\App\Http\Controllers\RestTeamController::class,'getTeams']);
Route::get('getFeatured',[\App\Http\Controllers\FrontendNewsController::class,'getFeaturedNews']);
Route::get('popularNews',[\App\Http\Controllers\FrontendNewsController::class,'getPopularNews']);
Route::get('getAllMatches',[\App\Http\Controllers\RestMatchController::class,'getAllMatches']);
Route::get('getData/{id}',[\App\Http\Controllers\RestMatchController::class,'getMatchLeague']);
Route::get('getLatestMatch/{id}',[\App\Http\Controllers\RestMatchController::class,'getLatestMatches']);
Route::post('register-api',[\App\Http\Controllers\Backend\LoginController::class,'register'])->name('register-api');
Route::post('login-api',[\App\Http\Controllers\Backend\LoginController::class,'login'])->name('login-api');
Route::get('getLatestNews',[\App\Http\Controllers\FrontendNewsController::class,'getLatestNews']);



