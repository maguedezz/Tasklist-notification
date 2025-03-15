<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::patch('/tasks/{task}/complete', [TaskController::class, 'markCompleted'])->name('tasks.complete');
});

// Route::get('/notifications', [NotificationController::class, 'index'])
//     ->middleware('auth')
//     ->name('notifications.index');

// Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
//     ->middleware('auth')
//     ->name('notifications.read');

// Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])
//     ->name('notifications.destroy');    

require __DIR__.'/auth.php';
