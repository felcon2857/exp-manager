<?php

use App\Http\Controllers\ExpensesCategoryController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//roles api reuqest
Route::post("/role/save", [RolesController::class, 'saveRole']);
Route::post("/role/update/{id}", [RolesController::class, 'updateRole']);
Route::get("/role/getall", [RolesController::class, 'getAllRole']);
Route::post("/role/getone/{id}", [RolesController::class, 'getOneRole']);
Route::post("/role/delete/{id}", [RolesController::class, 'deleteRole']);

// users api request
Route::post("/users/save", [UsersController::class, 'addUser']);
Route::post("/users/update/{id}", [UsersController::class, 'updateUser']);
Route::get("/users/getall", [UsersController::class, 'getAllUser']);
Route::post("/users/getone/{id}", [UsersController::class, 'getOneUser']);
Route::post("/users/delete/{id}", [UsersController::class, 'deleteUser']);

// expense api request

// expense category api request
Route::post("/category/save", [ExpensesCategoryController::class, 'saveCategory']);
Route::post("/category/update/{id}", [ExpensesCategoryController::class, 'updateCategory']);
Route::get("/category/getall", [ExpensesCategoryController::class, 'getAllCategory']);
Route::post("/category/getone/{id}", [ExpensesCategoryController::class, 'getOneCategory']);
Route::post("/category/delete/{id}", [ExpensesCategoryController::class, 'deleteCategory']);
