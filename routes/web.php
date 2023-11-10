<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarReturnController;
use App\Http\Controllers\CarRentalController;
use App\Http\Controllers\CarManagementController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/store', [RegisteredUserController::class, 'store'])->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/manage-cars', [CarManagementController::class, 'index'])->name('manage-cars');
Route::get('/car-rentals', [CarRentalController::class, 'index'])->name('car-rentals');
Route::get('/car-returns', [CarReturnController::class, 'index'])->name('car-returns');

Route::get('/cars/create', [CarManagementController::class, 'create'])->name('cars.create');
Route::post('/cars', [CarManagementController::class, 'store'])->name('cars.store');
Route::delete('/manage-cars/{id}', [CarManagementController::class, 'destroy'])->name('cars.destroy');


require __DIR__ . '/auth.php';
