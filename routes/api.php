<?php

use App\Http\Controllers\ProposalController;
use Illuminate\Support\Facades\Route;

// API routes for mobile client and admin actions
Route::get('/proposals', [ProposalController::class, 'listAll']);
Route::post('/proposals', [ProposalController::class, 'store']);
Route::get('/proposals/{code}', [ProposalController::class, 'track']);
Route::put('/proposals/{code}/status', [ProposalController::class, 'updateStatus']);
Route::delete('/proposals/{code}', [ProposalController::class, 'destroy']);
