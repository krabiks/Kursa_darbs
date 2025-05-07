<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\MachinesController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\EquipmentSummaryController;

/*
|--------------------------------------------------------------------------
| Publiskie maršruti
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard - pieejams tikai autentificētiem lietotājiem
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Autentificētiem lietotājiem pieejamie maršruti
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Lietotāja profils
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Tehnikas kopsavilkuma skats
    |--------------------------------------------------------------------------
    */
    Route::get('/summary', [EquipmentSummaryController::class, 'index'])->name('summary.index');
});

/*
|--------------------------------------------------------------------------
| Resursu maršruti
|--------------------------------------------------------------------------
*/
Route::resource('employees', EmployeesController::class);
Route::resource('machines', MachinesController::class);
Route::resource('records', RecordsController::class);

/*
|--------------------------------------------------------------------------
| Autentifikācija
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
