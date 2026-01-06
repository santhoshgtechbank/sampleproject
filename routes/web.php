<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // File Upload Routes
    Route::get('/upload', [FileUploadController::class, 'showUploadForm'])->name('upload.form');
    Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload.file');
});

require __DIR__.'/auth.php';
