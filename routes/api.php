<?php

use App\Http\Controllers\CredentialController;
use Illuminate\Support\Facades\Route;

Route::get('/credentials', [CredentialController::class, 'listAll']);
Route::post('/credentials', [CredentialController::class, 'create']);
Route::post('/access', [CredentialController::class, 'access']);