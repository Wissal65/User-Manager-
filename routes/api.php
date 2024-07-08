<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
// Route::middleware(['auth:sanctum', 'type'])->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'dashboard']);
// });
Route::group(['middleware' => ['auth:sanctum', 'admin']],function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users', [AdminController::class, 'getUsers']);
    Route::post('/users', [AdminController::class, 'addUser']);
    Route::get('/users/{id}', [AdminController::class, 'getUserById']);
    Route::put('/users/{id}', [AdminController::class, 'updateUser']);
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser']);

    // Add other admin routes here
});


// Route::middleware(['auth:sanctum', 'admin:1'])->get('/admin', function () {
//     return response()->json(['message' => 'Admin Route']);
// });

// Route::middleware(['auth:sanctum', 'admin:0'])->get('/user', function () {
//     return response()->json(['message' => 'User Route']);
// });
// Route::middleware(['auth:sanctum', 'type:1'])->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return response()->json(['message' => 'Welcome to Admin Dashboard']);
//     });
// });

// Route::middleware(['auth:sanctum', 'type:0'])->group(function () {
//     Route::get('/user/profile', function () {
//         return response()->json(['message' => 'Welcome to User Profile']);
//     });
// });

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
