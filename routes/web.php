<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\InviteController;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
        $user = Auth::user();

return Inertia::render('Dashboard', [

        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'is_admin' => (bool) $user->is_admin, //cast to Boolean
        'status' => session('status'),
        'incentive_current' => $user->incentive_current,
        'incentive_tier' => (string) $user->incentive_tier,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/invite/send', [InviteController::class, 'send'])->name('invite.send');
});

// Reuse Breeze’s registration handler
Route::post('/invite/register', [RegisteredUserController::class, 'store'])
    ->name('invite.register.store');

// Admin route to send invites
Route::post('/invite/send', [InviteController::class, 'send'])
    ->middleware('auth')
    ->name('invite.send');


require __DIR__.'/auth.php';
