<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




       Route::get('/admin/home', [AdminDashboardController::class, 'index'])->name('admin.index');
     Route::get('/admin/logout', [AdminDashboardController::class, 'logout'])->name('admin.logout');
        Route::get('/admin/profile', [AdminDashboardController::class, 'adminprofile'])->name('admin.profile');
    


  
    // Add more admin routes here




require __DIR__.'/auth.php';


         
 