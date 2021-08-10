<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ClientController;
use \App\Http\Controllers\AccountController;
use App\Http\Controllers\IndexController;

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

Route::get('/', [IndexController::class, "index"]);

Route::get('/filter/', [IndexController::class, "filterClients"])
    ->name("filter");

Route::get('/list/{count}', [IndexController::class, "listClients"])
    ->name("list");

Route::group(['middleware' => ['xss']], function () {
    Route::group(["prefix" => "client"], function () {
        Route::post('/', [ClientController::class, "createClient"])
            ->name("client_create");

        Route::get('/search/{client_param}', [ClientController::class, "findClientByParam"])
            ->name("client_search");

    });
    Route::post('/account', [AccountController::class, "createAccount"])
        ->middleware("iban")
        ->name("account_create");
});

