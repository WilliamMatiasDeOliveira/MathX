<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'home'])->name('home');

Route::post('/generate_exercises', [MainController::class, 'generate_exercises'])->name('generate_exercises');

Route::get('/print_exercises', [MainController::class, 'print_exercises'])->name('print_exercises');

Route::get('/export_exercises', [MainController::class, 'export_exercises'])->name('export_exercises');




