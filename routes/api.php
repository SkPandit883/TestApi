<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\CacheController;
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

Route::apiResources([
    'posts' => PostController::class,
    'comments' => CommentController::class,
    'views' => ViewController::class,
]);
Route::get('userReport/{userId}/{postId}',[PostController::class,'userReport']);
Route::post('postReport',[PostController::class,'postReport']);
Route::get('testCache/{name}',[CacheController::class,'testCache']);