<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Mail\EventReminder;
use App\Models\Event;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardUserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/event', [EventController::class, 'store'])->name('event.store');
    Route::put('event/update/{event}', [EventController::class, 'update'])->name('event.update');
    Route::patch('event/selesaikan/{event}', [EventController::class, 'change'])->name('event.change');
    Route::delete('event/delete/{event}', [EventController::class, 'destroy'])->name('event.delete');
    Route::get('/test-email/{event}', function ($eventId) {
    $event = Event::findOrFail($eventId);
    Mail::to('recipient@example.com')->send(new EventReminder($event));
    return 'Email telah dikirim!';
    });
});

require __DIR__.'/auth.php';
