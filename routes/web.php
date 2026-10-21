<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

// 1. FolioFlow Home Page
Route::get('/', function () {
    return view('home');
})->name('home');

// 2. Redirect the default Breeze dashboard to our portfolios page
Route::get('/dashboard', function () {
    return redirect()->route('portfolio.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. All Portfolio Routes (Protected by Login)
Route::middleware('auth')->group(function () {
    Route::get('/portfolios', [PortfolioController::class, 'index'])->name('portfolio.index');
    Route::get('/portfolios/create', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolios', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/portfolios/{id}/select-template', [PortfolioController::class, 'selectTemplate'])->name('portfolio.selectTemplate');
    Route::post('/portfolios/{id}/select-template', [PortfolioController::class, 'updateTemplate'])->name('portfolio.updateTemplate');
    Route::get('/portfolios/{id}/preview', [PortfolioController::class, 'show'])->name('portfolio.show');
    Route::get('/portfolios/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/portfolios/{id}', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::delete('/portfolios/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');
});

// 4. Breeze Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 5. Breeze Auth Routes (Login, Register, Logout)
require __DIR__.'/auth.php';
// force rebuild
// Force rebuild 2