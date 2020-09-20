<?php

use App\Http\Controllers\TeamController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/team/index',[TeamController::class, 'index'])->name('index');

Route::get('/team/create',[TeamController::class, 'create']);

Route::post('/team/store',[TeamController::class, 'store'])->name('store');

Route::get('/team/show/{id}', [TeamController::class, 'show'])->name('show');

Route::get('/pokemon/catch', [TeamController::class, 'catch'])->name('catch');
