<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;

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

    Route::prefix('houses')->group(function () {
        Route::post('/', [HouseController::class, 'index'])
            ->name('house.list');
        Route::get('/featured', [HouseController::class, 'featured'])
            ->name('house.featured');
        Route::get('/similar', [HouseController::class, 'similar'])
            ->name('house.similar');
        Route::post('/filter', [HouseController::class, 'filter'])
            ->name('house.filter');
        Route::get('/{id}', [HouseController::class, 'show'])
            ->name('house.show');
    });

    Route::prefix('review')->group(function () {
        Route::post('/store', [ReviewController::class, 'store'])
            ->name('review.store');
        Route::post('/like', [ReviewController::class, 'like'])
            ->name('review.like');
    });

    Route::prefix('user')->group(function () {
        Route::get('/getBm', [UserController::class, 'getBm'])
            ->name('house.get-bookmark');
        Route::post('/addBm', [UserController::class, 'storeBm'])
            ->name('house.add-bookmark');
        Route::delete('/deleteBm', [UserController::class, 'deleteBm'])
            ->name('house.delete-bookmark');
    });
// });
