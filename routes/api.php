<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\HouseUtilityController;

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

// Route::group(['middleware' => ['web']], function () {

Route::post('/login', [LoginController::class, 'index']);

Route::prefix('posts')->group(function () {
    Route::post('/', [PostController::class, 'index'])
        ->name('post.list');
    Route::get('/featured', [PostController::class, 'featured'])
        ->name('post.featured');
    Route::get('/similar', [PostController::class, 'similar'])
        ->name('post.similar');
    Route::post('/filter', [PostController::class, 'filter'])
        ->name('post.filter');
    Route::get('/{id}', [PostController::class, 'show'])
        ->name('post.show');
    Route::post('/store', [PostController::class, 'store'])
        ->name('post.store');
});

Route::prefix('review')->group(function () {
    Route::post('/store', [ReviewController::class, 'store'])
        ->name('review.store');
    Route::post('/like', [ReviewController::class, 'like'])
        ->name('review.like');
});

Route::prefix('user')->group(function () {
    Route::get('/getBm', [UserController::class, 'getBm'])
        ->name('post.get-bookmark');
    Route::post('/addBm', [UserController::class, 'storeBm'])
        ->name('post.add-bookmark');
    Route::delete('/deleteBm', [UserController::class, 'deleteBm'])
        ->name('post.delete-bookmark');
});

Route::prefix('utilities')->group(function () {
    Route::get('/', [UtilityController::class, 'index'])
        ->name('utility.list');
    Route::post('/store', [HouseUtilityController::class,'store'])
        ->name('utility.store');
});
// });
