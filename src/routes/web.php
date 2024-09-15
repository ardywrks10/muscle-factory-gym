<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasViewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MemberViewController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\TrainerViewController;
use App\Http\Controllers\FasilitasViewController;
use App\Http\Controllers\TransaksiViewController;
use App\Http\Controllers\Auth\LupaPasswordController;


Route::middleware(['auth'])->group(function () {
    Route::resource('member', MemberViewController::class);
    Route::resource('trainer', TrainerViewController::class);
    Route::resource('transaksi', TransaksiViewController::class);
    Route::resource('kelas', KelasViewController::class);
    Route::resource('fasilitas', FasilitasViewController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);

Route::get('sign-up', [SignUpController::class, 'signUpForm'])->name('sign-up');
Route::post('sign-up', [SignUpController::class, 'signUp']);

Route::get('password/reset', function () {
    return view('auth.email');
})->name('password.request');

Route::post('password/email', [LupaPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', function ($token) {
    return view('auth.reset', ['token' => $token]);
})->name('password.reset');

Route::post('password/reset', [LupaPasswordController::class, 'reset'])->name('password.update');



