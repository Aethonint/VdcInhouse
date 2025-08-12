<?php

use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\VehicleController;



/*
|--------------------------------------------------------------------------
| Landing & Login Routes
|--------------------------------------------------------------------------
| '/' will redirect logged-in users to their dashboard
| Guests will see the login page
*/
Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect()->route('admin.index')
            : redirect()->route('user.index');
    }
    return view('auth.login');
})->name('home')->middleware('web'); // only web middleware, no guest here

/*
|--------------------------------------------------------------------------
| Authentication Routes (Login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| Logout (Shared for all roles)
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Profile Routes (Shared for all roles)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::get('/admin/home', [AdminDashboardController::class, 'index'])->name('admin.index');
     Route::get('/admin/Dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminDashboardController::class, 'adminprofile'])->name('admin.profile');
    Route::get('/admin/edit', [AdminDashboardController::class, 'changepassword'])->name('admin.changepassword');
    // Vehicle List Index
    Route::get('/vehicle/list', [VehicleController::class, 'index'])->name('vehicle.index');
      Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicle.create');
      // Drivers section all routes
      Route::get('/drivers', [DriverController::class, 'index'])->name('driver.index');
      Route::get('/drivers/create', [DriverController::class, 'create'])->name('driver.create');
        Route::POST('/drivers/store', [DriverController::class, 'store'])->name('driver.store');
            Route::get('/drivers/show/{id}', [DriverController::class, 'show'])->name('driver.show');
        Route::get('/drivers/edit/{id}', [DriverController::class, 'edit'])->name('driver.edit');
            Route::PUT('/drivers/update/{id}', [DriverController::class, 'update'])->name('driver.update');
         Route::delete('/drivers/delete/{id}', [DriverController::class, 'destroy'])->name('driver.destroy');
           //END Drivers section all routes
      
      


   
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'checkRole:user'])->group(function () {
    Route::get('/user/home', [UserController::class, 'index'])->name('user.index');
    
});

require __DIR__.'/auth.php';
