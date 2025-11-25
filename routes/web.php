<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChargerdataController;

 Route::get('/', function () {
        // If user is already authenticated (remember me or regular session), redirect to dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    });

    Route::post('/login', [UserController::class, 'login'])->name('LoginUser');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');



        Route::group(['prefix' => 'users'], function () {
        Route::get('/list', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        });

        Route::group(['prefix' => 'charger'], function () {
            Route::get('/list', [ChargerdataController::class, 'index'])->name('charger.list');
            Route::get('/create', [ChargerdataController::class, 'create'])->name('charger.create');
            Route::post('/', [ChargerdataController::class, 'store'])->name('charger.store');
            Route::get('/{charger}/edit', [ChargerdataController::class, 'edit'])->name('charger.edit');
            Route::post('/{charger}', [ChargerdataController::class, 'update'])->name('charger.update');
            Route::delete('/{charger}', [ChargerdataController::class, 'destroy'])->name('charger.destroy');
            Route::get('/pending', [ChargerdataController::class, 'pending'])->name('charger.pending');
            Route::get('/dispatch', [ChargerdataController::class, 'dispatch'])->name('charger.dispatch');
            Route::post('/charger/update-status', [ChargerdataController::class, 'updateStatus'])->name('charger.update.status');
        });


 });

