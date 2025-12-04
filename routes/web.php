<?php

use App\Http\Controllers\PrecenseController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



// Landing page (login form)
Route::get('/', function () {
    return view('landingpage');  // file landingpage.blade.php
})->name('landingpage');

// Login POST action
Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');

// Logout
Route::get('/logout', [UserController::class, 'logout'])
    ->name('logout');







Route::middleware('isAdmin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/precenses/chart', [PrecenseController::class, 'chartData'])->name('precenses.chart');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');


    Route::prefix('/precenses')->name('precenses.')->group(function () {
        Route::get('/', [PrecenseController::class, 'index'])->name('index');
        Route::get('/export', [PrecenseController::class, 'exportExcel'])->name('export');
    });


    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
         Route::get('create', function () {
            return view('admin.users.create');
        })->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('delete');
        Route::get('/datatables', [UserController::class,'datatables'])->name('datatables');

        Route::get('/export', [UserController::class, 'exportExcel'])->name('export');

        Route::get('/trash', [UserController::class,'trash'])->name('trash');
        Route::patch('/restore/{id}', [UserController::class,'restore'])->name('restore');
        Route::delete('/delete-permanent/{id}', [UserController::class, 'deletePermanent'])->name('delete_permanent');
    });



});














Route::middleware('isStaff')->prefix('/staff')->name('staff.')->group(function () {

    Route::get('/dashboard', function () {
        return view('staff.dashboard');
    })->name('dashboard');

   Route::post('/store', [PrecenseController::class, 'store'])->name('store');

});
