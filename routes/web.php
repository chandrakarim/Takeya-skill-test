<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Post Routes (Skill Test Requirement)
|--------------------------------------------------------------------------
*/

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{id}/edit', [PostController::class, 'edit']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::patch('/posts/{id}', [PostController::class, 'update']); // wajib
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
