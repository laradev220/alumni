<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Alumni\Directory as AlumniDirectory;
use App\Livewire\Alumni\ProfileEdit;
use App\Livewire\Alumni\ProfileView;

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

    Route::get('/alumni', AlumniDirectory::class)->name('alumni.directory');
    Route::get('/alumni/{userId}', ProfileView::class)->name('alumni.profile');
    Route::get('/alumni/profile/edit', ProfileEdit::class)->name('alumni.profile.edit');
});

require __DIR__.'/auth.php';
