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
    return redirect()->route('login'); // Pāradresē uz login
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
    | Ieraksti - pieejami visiem lietotājiem
    |--------------------------------------------------------------------------
    */
    Route::resource('records', RecordsController::class);
});

/*
|--------------------------------------------------------------------------
| Admin maršruti - pieejami tikai administratoriem
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('employees', EmployeesController::class);
    Route::resource('machines', MachinesController::class);
    Route::get('/summary', [EquipmentSummaryController::class, 'index'])->name('summary.index');
});

/*
|--------------------------------------------------------------------------
| Autentifikācija
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
