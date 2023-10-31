<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedditAuthController;
use App\Http\Controllers\RedditController;
use App\Http\Controllers\RedditPostController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login/reddit', [RedditAuthController::class,'redirectToReddit']);
Route::get('/login/reddit/callback',[RedditAuthController::class,'handleRedditCallback']);
Route::get('/reddit-posts', [RedditController::class,'index']);
Route::get('/create-reddit-post',[RedditPostController::class,'index']);
Route::get('/create-reddit-post',[RedditPostController::class,'create']);