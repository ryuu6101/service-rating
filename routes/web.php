<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\SectionController as AdminController;
use App\Http\Controllers\Web\SectionController as WebController;

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

Route::get('/', [WebController::class, 'home'])->name('home.index');
Route::get('/survey', [WebController::class, 'survey'])->name('home.survey');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.auth');
});

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('admin')->group(function () {
        Route::redirect('/', 'admin/rating-staticals');
        Route::get('users', [AdminController::class, 'users'])->name('users.index');
        // Route::get('client-service', [AdminController::class, 'clientService'])->name('client-service.index');
        Route::get('rating-staticals', [AdminController::class, 'ratingStaticals'])->name('rating-staticals.index');
    });
});
