<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CageController;
Use App\Http\Controllers\AnimalController;
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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [CageController::class, 'index'])->name('cages.index');
Route::get('animals', [AnimalController::class, 'index'])->name('animals.index');
Route::get('/animals/{animal}', [AnimalController::class, 'show'])->name('animals.show');



Route::middleware('auth')->group(function () {
    Route::get('cages/create', [CageController::class, 'create'])->name('cages.create');
    Route::get('cages/{cage}/edit', [CageController::class, 'edit'])->name('cages.edit');
    Route::put('cages/{cage}', [CageController::class, 'update'])->name('cages.update');
    Route::delete('cages/{cage}', [CageController::class, 'destroy'])->name('cages.destroy');
    Route::get('animals/create', [AnimalController::class, 'create'])->name('animals.create');
    Route::post('animals', [AnimalController::class, 'store'])->name('animals.store');
    Route::get('animals/{animal}/edit', [AnimalController::class, 'edit'])->name('animals.edit');
    Route::put('animals/{animal}', [AnimalController::class, 'update'])->name('animals.update');
    Route::delete('animals/{animal}', [AnimalController::class, 'destroy'])->name('animals.destroy');
    Route::post('cages', [CageController::class, 'store'])->name('cages.store');



});

