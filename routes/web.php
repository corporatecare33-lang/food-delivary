<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\HomePage;
use App\Livewire\MerchantDetails;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

use App\Livewire\Merchant\Dashboard as MerchantDashboard;
use App\Livewire\Merchant\MenuManager;
use App\Livewire\Customer\OrderHistory;
use App\Livewire\Rider\Dashboard as RiderDashboard;

Route::get('/', HomePage::class)->name('home');

// Role-based Redirect Dashboard
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isAdmin()) return redirect()->route('admin.dashboard');
    if ($user->isMerchant()) return redirect()->route('merchant.dashboard');
    if ($user->isRider()) return redirect()->route('rider.dashboard');
    if ($user->isCustomer()) return redirect()->route('customer.orders');
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

// Merchant Routes
Route::middleware(['auth', 'merchant'])->prefix('merchant')->name('merchant.')->group(function () {
    Route::get('/dashboard', MerchantDashboard::class)->name('dashboard');
    Route::get('/menu', MenuManager::class)->name('menu');
});

Route::get('/merchant/{slug}', MerchantDetails::class)->name('merchant.details');

// Rider Routes
Route::middleware(['auth', 'rider'])->prefix('rider')->name('rider.')->group(function () {
    Route::get('/dashboard', RiderDashboard::class)->name('dashboard');
});

// Customer Routes
Route::middleware(['auth'])->prefix('my')->name('customer.')->group(function () {
    Route::get('/orders', OrderHistory::class)->name('orders');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [AdminDashboardController::class, 'index'])->name('orders');
    Route::get('/merchants', [AdminDashboardController::class, 'index'])->name('merchants');
    Route::get('/riders', [AdminDashboardController::class, 'index'])->name('riders');
    Route::get('/customers', [AdminDashboardController::class, 'index'])->name('customers');
    Route::get('/commission', [AdminDashboardController::class, 'index'])->name('commission');
    Route::get('/settings', [AdminDashboardController::class, 'index'])->name('settings');
    Route::get('/logs', [AdminDashboardController::class, 'index'])->name('logs');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
