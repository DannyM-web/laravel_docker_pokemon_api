<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
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

// Route::get('/', function () {
//     return view('home');
// });


// REGISTER ROUTES
Route::get('/register', [RegisterController::class, 'register']) -> name('register_form');
Route::post('/reg', [RegisterController::class, 'storeUser'])-> name('register');

//LOGIN ROUTES
Route::get('/login', [LoginController::class,'login'])->name('login_form');
Route::post('/auth', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/team/create',[TeamController::class, 'create'])->name('create')->middleware('auth');
Route::post('/team/store',[TeamController::class, 'store'])->name('store')->middleware('auth');

Route::get('/team/edit/{id}', [TeamController::class, 'edit'])->name('edit')->middleware('auth');
Route::post('/team/update/{id}', [TeamController::class, 'update'])->name('update')->middleware('auth');

Route::match(['get','delete'], '/team/delete/{id}', [TeamController::class, 'delete'])->name('delete')->middleware('auth');

Route::get('/',[TeamController::class,'index'])->name('index');
Route::get('/team/show/{id}', [TeamController::class, 'show'])->name('show');

Route::get('/pokemon/catch', [TeamController::class, 'catch'])->name('catch');

Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile');
Route::get('/filter', [ProfileController::class, 'filter'])->name('filter');
