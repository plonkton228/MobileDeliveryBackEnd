<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\saleController;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', [AuthController::class,'me']);
    Route::post('uPdate', [AuthController::class,'uPdate']);

});

Route::get('posts', [PostController::class,'index']);
Route::get('getPosts', [PostController::class,'getPosts']);
Route::get('posts/{post}', [PostController::class, 'show']);
Route::get('sales', [saleController::class,'index']);
// Route::post('sales',[saleController::class,'addSale']);
Route::post('sales', [saleController::class, 'RootFunc']);
Route::delete('sales/{id}', [saleController::class, 'DeletePost']);