<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManualController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {
    return redirect()->route('manuals.index');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/manuals', [ManualController::class, 'index'])->name('manuals.index');
    Route::get('/manuals/create', [ManualController::class, 'create'])->name('manuals.create');
    Route::post('/manuals', [ManualController::class, 'store'])->name('manuals.store');
    Route::get('/manuals/{manual}', [ManualController::class, 'show'])->name('manuals.show');
    Route::get('/manuals/{manual}/edit', [ManualController::class, 'edit'])->name('manuals.edit');
    Route::put('/manuals/{manual}', [ManualController::class, 'update'])->name('manuals.update');
    Route::delete('/manuals/{manual}', [ManualController::class, 'destroy'])->name('manuals.destroy');
});
