<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Livewire\Alumni\Directory as AlumniDirectory;
use App\Livewire\Alumni\ProfileEdit;
use App\Livewire\Alumni\ProfileView;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'alumniCount' => \App\Models\User::role('alumni')->count(),
        'upcomingEvents' => \App\Models\Event::where('date', '>=', now())->count(),
        'jobCount' => \App\Models\JobPost::count(),
        'events' => \App\Models\Event::where('date', '>=', now())->orderBy('date')->take(5)->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/alumni', AlumniDirectory::class)->name('alumni.directory');
    Route::get('/alumni/{userId}', ProfileView::class)->name('alumni.profile');
    Route::get('/alumni/profile/edit', ProfileEdit::class)->name('alumni.profile.edit');

    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});

require __DIR__.'/auth.php';
