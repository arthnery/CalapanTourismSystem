<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourismController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Public Routes
Route::get('/', [TourismController::class, 'index'])->name('home');
Route::get('/spots/{spot}', [TourismController::class, 'show'])->name('spots.show');

// Authentication Protected Routes (Dashboard & Profile)
Route::get('/dashboard', function (Request $request) {
    // Fetch common data for both dashboards
    $query = App\Models\TourismSpot::with('category');
    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
    }
    if ($request->has('category') && $request->category != '') {
        $query->where('category_id', $request->category);
    }
    $spots = $query->get();
    $categories = App\Models\Category::all();

    if (auth()->user()->role === 'admin') {
        return view('admin.dashboard', compact('spots', 'categories'));
    }

    return view('dashboard', compact('spots', 'categories'));
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin Specific Routes (Managing tourism spots)
    Route::prefix('admin')->name('admin.')->group(function () {
        // Restore route must come before the resource to avoid conflict or just be added separately
        Route::patch('spots/{spot}/restore', [App\Http\Controllers\Admin\TourismSpotController::class, 'restore'])->name('spots.restore');
        Route::resource('spots', App\Http\Controllers\Admin\TourismSpotController::class)->withTrashed();
        
        // Booking management for admin
        Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'adminIndex'])->name('bookings.index');

        // Activity Log for admin
        Route::get('/activity-log', [App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-log.index');
    });
});

Route::middleware(['auth', 'role:user'])->group(function () {
    // User Specific Routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'index'])->name('bookings.index');
        Route::post('/bookings', [App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');
    });
});

Route::middleware('auth')->group(function () {
    // Shared Booking cancellation
    Route::delete('/bookings/{booking}', [App\Http\Controllers\BookingController::class, 'destroy'])->name('bookings.destroy');

    // Profile Management Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
