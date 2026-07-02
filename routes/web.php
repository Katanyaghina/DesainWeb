<?php

use App\Http\Controllers\ProposalController;
use Illuminate\Support\Facades\Route;

// Public client portal (Formulir pengajuan & Pelacakan)
Route::get('/', [ProposalController::class, 'index'])->name('portal');
Route::post('/proposals', [ProposalController::class, 'store'])->name('proposals.store');

// Admin Auth (AJAX)
Route::post('/login', [ProposalController::class, 'login'])->name('login.submit');
Route::post('/logout', [ProposalController::class, 'logout'])->name('logout');

// Admin panel dashboard (protected by session check)
Route::get('/admin', [ProposalController::class, 'adminIndex'])->name('admin.dashboard');
