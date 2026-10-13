<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

/*
|--------------------------------------------------------------------------
| Web Routes — FolioFlow
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/', function () {
    return view('home');
})->name('home');

/*
|--------------------------------------------------------------------------
| Portfolio Routes (all handled by PortfolioController)
|--------------------------------------------------------------------------
*/

// Manage / list all portfolios
Route::get('/portfolios', [PortfolioController::class, 'index'])
    ->name('portfolio.index');

// Create form
Route::get('/portfolios/create', [PortfolioController::class, 'create'])
    ->name('portfolio.create');

// Save new portfolio
Route::post('/portfolios', [PortfolioController::class, 'store'])
    ->name('portfolio.store');

// Template selection screen
Route::get('/portfolios/{id}/select-template', [PortfolioController::class, 'selectTemplate'])
    ->name('portfolio.selectTemplate');

// Save chosen template
Route::post('/portfolios/{id}/select-template', [PortfolioController::class, 'updateTemplate'])
    ->name('portfolio.updateTemplate');

// Preview generated portfolio
Route::get('/portfolios/{id}/preview', [PortfolioController::class, 'show'])
    ->name('portfolio.show');

// Edit form
Route::get('/portfolios/{id}/edit', [PortfolioController::class, 'edit'])
    ->name('portfolio.edit');

// Save edited data
Route::put('/portfolios/{id}', [PortfolioController::class, 'update'])
    ->name('portfolio.update');

// Delete portfolio
Route::delete('/portfolios/{id}', [PortfolioController::class, 'destroy'])
    ->name('portfolio.destroy');