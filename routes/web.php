<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainMenuController;

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

Route::get('/', [MainMenuController::class, 'index']);

Route::get('/home', [MainMenuController::class, 'home']);

Route::get('/refreshStatus', [MainMenuController::class, 'refreshStatus']);