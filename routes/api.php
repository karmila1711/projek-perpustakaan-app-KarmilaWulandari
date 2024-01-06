<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\BooksController;
use App\Http\Controllers\Api\Admin\AuthorController;
use App\Http\Controllers\Api\Admin\LoginController;

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

// Group route with prefix "admin"
Route::prefix('admin')->group(function () {

    // Route login
    Route::post('/login', [LoginController::class, 'index']);

    // Group route with middleware "auth"
    Route::group(['middleware' => 'auth:api'], function () {

        // Data user
        Route::get('/user', [LoginController::class, 'getUser']);

        // Refresh token JWT
        Route::get('/refresh', [LoginController::class, 'refreshToken']);

        // Logout
        Route::post('/logout', [LoginController::class, 'logout']);

        // CRUD routes for Books
        Route::apiResource('/books', App\Http\Controllers\Api\Admin\BooksController::class);

        // CRUD routes for Authors
        Route::get('/authors', [AuthorController::class, 'index']);
        Route::post('/authors', [AuthorController::class, 'saveAuthors']);
    });
});
