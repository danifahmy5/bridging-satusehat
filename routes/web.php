<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrganisasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/ 
 
Route::get('/', [OrganisasiController::class, 'index'])->name('organisasi.index');
Route::get('/organisasi/create', [OrganisasiController::class, 'create'])->name('organisasi.create');
Route::get('/token/generate', [OrganisasiController::class, 'generateToken'])->name('organisasi.generateToken');
Route::post('/organisasi', [OrganisasiController::class, 'store'])->name('organisasi.store');

Route::get('/location', [LocationController::class, 'index'])->name('location.index');
Route::get('/location/create', [LocationController::class, 'create'])->name('location.create');
Route::get('/token/generate', [LocationController::class, 'generateToken'])->name('location.generateToken');
Route::post('/location', [LocationController::class, 'store'])->name('location.store');

