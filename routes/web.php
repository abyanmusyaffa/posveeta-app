<?php

use App\Models\Pesanan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\TransaksiController;

Route::get('/auth', [UserController::class, 'index'])->name('login')->middleware('guest');
Route::post('/auth', [UserController::class, 'authenticate']);
Route::post('/logout', [UserController::class, 'logout']);

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/barang', [BarangController::class, 'index'])->middleware('auth');
Route::post('/barang', [BarangController::class, 'store']);
Route::post('/barang-edit', [BarangController::class, 'update']);
Route::delete('/barang-hapus/{id}', [BarangController::class, 'delete']);

Route::get('/pesanan', [PesananController::class, 'index'])->middleware('auth');
Route::post('/pesanan', [PesananController::class, 'store']);
Route::post('/pesanan-edit', [PesananController::class, 'update']);
Route::delete('/pesanan-hapus/{id}', [PesananController::class, 'delete']);

Route::get('/penjualan', [PenjualanController::class, 'index'])->middleware('auth');
Route::post('/penjualan-proses', [PenjualanController::class, 'confirmation']);
Route::post('/penjualan', [PenjualanController::class, 'store']);

Route::get('/transaksi', [TransaksiController::class, 'index'])->middleware('auth');
Route::post('/tpe-edit', [TransaksiController::class, 'update']);
Route::delete('/tpe-hapus/{id}', [TransaksiController::class, 'delete']);
Route::post('/tp-edit', [TransaksiController::class, 'update_']);
Route::delete('/tp-hapus/{id}/{idp}', [TransaksiController::class, 'delete_']);