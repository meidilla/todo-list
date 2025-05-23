<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CalculatorController; // BARIS INI DITAMBAHKAN
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ DashboardController::class, 'view' ]);

Route::post('/item', [ ItemController::class, 'insert' ]);
Route::delete('/item/{id}', [ ItemController::class, 'delete' ])->name('item.destroy');

// Rute untuk kalkulator (BARIS INI DITAMBAHKAN)
Route::get('/calculator', [CalculatorController::class, 'show']);
Route::post('/calculate', [CalculatorController::class, 'calculate']);