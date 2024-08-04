<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InchargeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Controller::class, 'index'])->name('index')->middleware('guest');
Route::get('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate')->middleware('guest');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Guests
Route::group(['prefix' => '/guests', 'as' => 'guests.', 'middleware' => ['guest']], function () {
  Route::resource('announcements', AnnouncementController::class)->only(['show']);
});

// Clients
Route::group(['prefix' => '/clients', 'as' => 'clients.', 'middleware' => ['auth', 'client']], function () {
  Route::get('/index', [ClientController::class, 'index'])->name('index');
  Route::get('/announcements/{announcement}', [ClientController::class, 'show'])->name('announcements.show');
});

// Incharges
Route::group(['prefix' => '/incharges', 'as' => 'incharges.', 'middleware' => ['auth', 'incharge']], function () {
  Route::get('/index', [InchargeController::class, 'index'])->name('index');
  Route::get('/announcements/{announcement}', [InchargeController::class, 'show'])->name('announcements.show');
});

// Admins
Route::group(['prefix' => '/admins', 'as' => 'admins.', 'middleware' => ['auth', 'admin']], function () {
  Route::get('/index', [AdminController::class, 'index'])->name('index');
  Route::get('/announcements/{announcement}', [AdminController::class, 'show'])->name('announcements.show');
});

// Post Comment
Route::group(['prefix' => '/announcements', 'as' => 'announcements.', 'middleware' => ['auth']], function () {
  Route::resource('comments', CommentController::class)->only('store');
});

Route::group(['middleware' => ['auth']], function () {
  // <Announcements></Announcements>
  Route::resource('announcements', AnnouncementController::class)->only(['index', 'store', 'update', 'destroy']);

  // User
  Route::resource('users', UserController::class)->only('update', 'show', 'index', 'destroy');
});
