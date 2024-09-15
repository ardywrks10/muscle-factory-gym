<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\ResetPassController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AutentikasiController;

Route::post('/sign-up', [AutentikasiController::class, 'sign_up'])->name('sign_up');
Route::post('/login', [AutentikasiController::class, 'login'])->name('login');

Route::post('/password/email', [ResetPassController::class, 'sendResetLinkEmail'])->name('email_lupapassword');
Route::post('/password/reset', [ResetPassController::class, 'reset'])->name('password.reset');

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/logout', [AutentikasiController::class, 'logout']);
    Route::post('/change_password', [AutentikasiController::class, 'change_password']);

    Route::post('/trainer', [TrainerController::class, 'create_trainer']);
    Route::post('/trainer/{id}', [TrainerController::class, 'update_trainer']);
    Route::delete('/trainer/{id}', [TrainerController::class, 'destroy_trainer']);
    Route::get('/trainer', [TrainerController::class, 'view_trainer']);

    Route::post('/member', [MemberController::class, 'create_member']);
    Route::post('/member/{id}', [MemberController::class, 'update_member']);
    Route::delete('/member/{id}', [MemberController::class, 'destroy_member']);
    Route::get('/member', [MemberController::class, 'view_member']);

    Route::post('/kelas', [KelasController::class, 'create_kelas']);
    Route::post('/kelas/{id}', [KelasController::class, 'update_kelas']);
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy_kelas']);
    Route::get('/kelas', [KelasController::class, 'view_kelas']);

    Route::post('/fasilitas', [FasilitasController::class, 'create_fasilitas']);
    Route::post('/fasilitas/{id}', [FasilitasController::class, 'update_fasilitas']);
    Route::delete('/fasilitas/{id}', [FasilitasController::class, 'destroy_fasilitas']);
    Route::get('/fasilitas', [FasilitasController::class, 'view_fasilitas']);

    
    Route::post('/trans', [TransaksiController::class, 'create_trans']);
    Route::post('/trans/{id}', [TransaksiController::class, 'update_trans']);
    Route::delete('/trans/{id}', [TransaksiController::class, 'destroy_trans']);
    Route::get('/trans', [TransaksiController::class, 'view_trans']);
});