<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\PhotoController;
use Illuminate\Support\Facades\Route;

// Health Check Route (for debugging)
Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'app' => config('app.name'),
        'env' => config('app.env'),
        'debug' => config('app.debug'),
        'key_set' => config('app.key') ? 'YES' : 'NO',
        'db_connection' => config('database.default'),
        'timestamp' => now()
    ]);
});

// Debug Route (temporary)
Route::get('/debug', function () {
    return response()->json([
        'php_version' => PHP_VERSION,
        'laravel_version' => app()->version(),
        'environment' => app()->environment(),
        'config_cached' => app()->configurationIsCached(),
        'routes_cached' => app()->routesAreCached(),
        'env_vars' => [
            'APP_KEY' => env('APP_KEY') ? 'SET' : 'NOT SET',
            'APP_ENV' => env('APP_ENV'),
            'APP_DEBUG' => env('APP_DEBUG'),
            'DB_CONNECTION' => env('DB_CONNECTION'),
        ]
    ]);
});

// Public Portfolio Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/gallery/{collection}', [PageController::class, 'showCollection'])->name('gallery.collection');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send');

// Authentication Dashboard (redirect to admin)
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes (Protected)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Collections Management
    Route::resource('collections', CollectionController::class);
    Route::post('collections/{collection}/toggle-status', [CollectionController::class, 'toggleStatus'])->name('collections.toggle-status');
    
    // Photos Management
    Route::resource('photos', PhotoController::class);
    Route::post('photos/upload', [PhotoController::class, 'upload'])->name('photos.upload');
    Route::post('photos/{photo}/toggle-featured', [PhotoController::class, 'toggleFeatured'])->name('photos.toggle-featured');
    Route::post('photos/bulk-update', [PhotoController::class, 'bulkUpdate'])->name('photos.bulk-update');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
