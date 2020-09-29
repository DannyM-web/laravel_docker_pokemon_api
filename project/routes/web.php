<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/register', [RegisterController::class, 'register'])->name('register_form')->middleware('guest');
Route::post('/reg', [RegisterController::class, 'storeUser'])->name('register');

//LOGIN ROUTES
Route::get('/login', [LoginController::class, 'login'])->name('login_form');
Route::post('/auth', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/team/create', [TeamController::class, 'create'])->name('create')->middleware('auth', 'accepted');
Route::post('/team/store', [TeamController::class, 'store'])->name('store')->middleware('auth', 'accepted');

Route::get('/team/edit/{id}', [TeamController::class, 'edit'])->name('edit')->middleware('auth', 'accepted');
Route::post('/team/update/{id}', [TeamController::class, 'update'])->name('update')->middleware('auth', 'accepted');

Route::match(['get', 'delete'], '/team/delete/{id}', [TeamController::class, 'delete'])->name('delete')->middleware('auth', 'accepted');

Route::get('/', [TeamController::class, 'index'])->name('index');

Route::get('/team/show/{id}', [TeamController::class, 'show'])->name('show')->middleware('auth', 'accepted');

Route::get('/pokemon/catch', [TeamController::class, 'catch'])->name('catch')->middleware('auth', 'accepted');

Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile')->middleware('auth', 'accepted');
Route::get('/filter', [ProfileController::class, 'filter'])->name('filter')->middleware('auth', 'accepted');


Route::get('/admin', [AdminController::class, 'adminPanel'])->name('admin')->middleware('admin');
Route::get('/admin/deleteCoach/{id}', [AdminController::class, 'deleteCoach'])->name('deleteCoach')->middleware('admin');

Route::get('/admin/editCoach/{id}', [AdminController::class, 'editCoachView'])->name('editCoach')->middleware('admin');
Route::post('/admin/updateCoach/{id}', [AdminController::class, 'updateCoach'])->name('updateCoach')->middleware('admin');
Route::get('/admin/requests', [AdminController::class, 'getRequests'])->name('requests')->middleware('admin');
Route::get('/admin/acceptPending/{id}', [AdminController::class, 'acceptPending'])->name('acceptPending')->middleware('admin');
Route::get('/admin/rejectPending/{id}', [AdminController::class, 'rejectPending'])->name('rejectPending')->middleware('admin');

Route::post('/admin/createCoach', [AdminController::class, 'createCoach'])->name('createCoach')->middleware('admin');

Route::get('/queue', [ProfileController::class, 'queue'])->name('queue')->middleware('auth');
