<?php

use Inertia\Inertia;
use App\Jobs\ProcessPayments;
use App\Jobs\SendWelcomeEMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    foreach(range(1, 10) as $i) {
        SendWelcomeEMail::dispatch();
        
    }

    ProcessPayments::dispatch()->onQueue('payments');

    // WHEN YOU DISPATCH A JOB, YOU CAN SPECIFY THE QUEUE TO WHICH IT SHOULD BE DISPATCHED
    // PHP artisan queue:work --queue=payments,default;


    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
