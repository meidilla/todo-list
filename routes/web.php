<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CalculatorController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ DashboardController::class, 'view' ]);

Route::post('/item', [ ItemController::class, 'insert' ]);
Route::delete('/item/{id}', [ ItemController::class, 'delete' ])->name('item.destroy');

// Rute untuk kalkulator (ini harus cocok dengan action di form dan yang ada di controller)
Route::get('/calculator', [CalculatorController::class, 'show']); // Untuk menampilkan form
Route::post('/calculator', [CalculatorController::class, 'calculate']); // Untuk memproses hasil POST