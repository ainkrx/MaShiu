<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controller::class, 'index']);
Route::get('/lang/{locale}', [Controller::class, 'setLang']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'loginPage']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [UserController::class, 'registerPage']);
    Route::post('/register', [UserController::class, 'register']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [ItemController::class, 'getAllItems']);

    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/profile', [UserController::class, 'profilePage']);
    Route::get('/profile/edit/', [UserController::class, 'editProfile']);
    Route::post('/profile/update/', [UserController::class, 'updateProfile']);

    Route::get('/item/view/{id}', [ItemController::class, 'itemPage']);

    Route::post('/cart/edit/{id}', [ItemController::class, 'editCart']);
});

Route::group(['middleware' => 'member'], function () {
    Route::get('/profile/password/edit', [UserController::class, 'editPassword']);
    Route::post('/profile/password/update', [UserController::class, 'updatePassword']);

    Route::get('/cart', [CartController::class, 'cart']);
    Route::get('/cart/edit', [CartController::class, 'cartChange']);
    Route::get('/cart/remove/{id}', [ItemController::class, 'removeFromCart']);

    Route::get('/history', [TransactionController::class, 'transactionPage']);

    Route::get('/checkOut', [TransactionController::class, 'addTransaction']);
    Route::post('/checkOut', [TransactionController::class, 'addTransaction']);
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/item/add', [ItemController::class, 'addItemPage']);
    Route::post('/item/add', [ItemController::class, 'addItem']);
    Route::get('/item/remove/{id}', [ItemController::class, 'deleteItem']);
});
