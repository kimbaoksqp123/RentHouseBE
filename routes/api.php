<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\HouseUtilityController;
use App\Http\Controllers\RequestViewHouseController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

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
    Route::get('/rent_house/index', [PostController::class, 'getRentHouse'])
        ->name('post.rent.house.index');
    Route::post('/{id}/{action}',[PostController::class, 'actionHouse'])
        ->name('post.action');
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
    Route::get('/{id}', [UserController::class, 'getUser']);
});

Route::prefix('utilities')->group(function () {
    Route::get('/', [UtilityController::class, 'index'])
        ->name('utility.list');
    Route::post('/store', [HouseUtilityController::class, 'store'])
        ->name('utility.store');
});

Route::prefix('request_view_houses')->group(function () {
    Route::get('/tenant_request/index', [RequestViewHouseController::class, 'getTenantRequestViewHouse'])
        ->name('request_view_house.tenant.request.index');

    Route::post('/tenant_request/{id}/{action}', [RequestViewHouseController::class, 'actionTenantRequestViewHouse'])
        ->name('request_view_house.tenant.request.action');

    Route::get('/rent_request/index', [RequestViewHouseController::class, 'getRentRequestViewHouse'])
        ->name('request_view_house.rent.request.index');

    Route::post('/rent_request/{id}/{action}', [RequestViewHouseController::class, 'actionRentRequestViewHouse'])
        ->name('request_view_house.rent.request.action');


    Route::post('/store', [RequestViewHouseController::class, 'store'])
        ->name('request_view_house.store');
});

Route::prefix('contracts')->group(function () {
    Route::post('/store', [ContractController::class, 'store'])
        ->name('contract.store');
    Route::get('/rent_contract/index', [ContractController::class, 'getRentContract']);
    Route::get('/tenant_contract/index', [ContractController::class, 'getTenantContract']);
});

// });
