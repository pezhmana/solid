<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureFollowing;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
route::post('login',[UserController::class,'login'])->name('login');
Route::group(['prefix'=>'user','middleware'=>'auth:sanctum'],function(){
   Route::post('/',[UserController::class,'createUser'])->withoutMiddleware('auth:sanctum')->name('create');
   Route::get('/{username}',[UserController::class,'index'])->middleware(EnsureFollowing::class)->name('index');
});

Route::group(['prefix'=>'follow','middleware'=>'auth:sanctum'],function(){
route::post('{following}',[FollowController::class,'send'])->name('send');
route::get('/',[FollowController::class,'indexRequest'])->name('indexRequest');
});

Route::group(['prefix'=>'post','middleware'=>'auth:sanctum'],function(){
    Route::post('/',[PostController::class,'create'])->name('create');
});
