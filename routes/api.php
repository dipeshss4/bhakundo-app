<?php

use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\FrontendNewsController;
use App\Http\Controllers\RestLeagueController;
use App\Http\Controllers\RestMatchController;
use App\Http\Controllers\RestPointsController;
use App\Http\Controllers\RestTeamController;
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


Route::middleware(['auth:api'])->group(function () {
    Route::get('logout-api',[LoginController::class,'logout'])->name('logout-api');
    Route::post('insert-comment',[FrontendNewsController::class,'insertComment']);
    Route::post('insert-reactions',[FrontendNewsController::class,'insertReaction']);
});
Route::get('getTrendingNews',[FrontendNewsController::class,'getTrendingNews']);
Route::post('uploadNewsImage',[\App\Http\Controllers\Backend\ImageController::class,'uploadImage']);
Route::get('getAllNews',[FrontendNewsController::class,'getAllNews']);
Route::get('getNews/{id}',[FrontendNewsController::class,'getNews']);
Route::get('getRecommendedNews',[FrontendNewsController::class,'getRecommendNews']);
Route::get('newsCategory',[FrontendNewsController::class,'getNewsCategory']);
Route::get('getAllTeams',[RestTeamController::class,'getAllTeams']);
Route::get('getAllLeague',[RestLeagueController::class,'getAllLeague']);
Route::get('getLeague/{id}',[RestLeagueController::class,'getLeague']);
Route::get('getTeams/{id}',[RestTeamController::class,'getTeams']);
Route::get('getFeatured',[FrontendNewsController::class,'getFeaturedNews']);
Route::get('popularNews',[FrontendNewsController::class,'getPopularNews']);
Route::get('getAllMatches',[RestMatchController::class,'getAllMatches']);
Route::get('getData/{id}',[RestMatchController::class,'getMatchLeague']);
Route::get('getLatestMatch/{id}',[RestMatchController::class,'getLatestMatches']);
Route::post('register-api',[LoginController::class,'register'])->name('register-api');
Route::post('login-api',[LoginController::class,'login'])->name('login-api');
Route::get('getLatestNews',[FrontendNewsController::class,'getLatestNews']);
Route::get('getNewsData/{id}',[FrontendNewsController::class,'getNewsAccordingCategory']);
Route::get('getAuthorPost/{id}',[FrontendNewsController::class,'getAuthorPost']);
Route::get('points/{id}',[RestPointsController::class,'getPointsTable']);
Route::patch('updateProfile/{id}',[LoginController::class,'editProfile']);
Route::get('getComments/{id}',[FrontendNewsController::class,'getComments']);
Route::get('getNationalTeams',[RestTeamController::class,'getNationTeams']);


