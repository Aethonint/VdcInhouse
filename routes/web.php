<?php

use App\Http\Controllers\Admin\AssignVehicleController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Api\DefectController;

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
  
      // Drivers section all routes
      Route::get('/drivers', [DriverController::class, 'index'])->name('driver.index');
      Route::get('/drivers/create', [DriverController::class, 'create'])->name('driver.create');
        Route::POST('/drivers/store', [DriverController::class, 'store'])->name('driver.store');
            Route::get('/drivers/show/{id}', [DriverController::class, 'show'])->name('driver.show');
        Route::get('/drivers/edit/{id}', [DriverController::class, 'edit'])->name('driver.edit');
            Route::PUT('/drivers/update/{id}', [DriverController::class, 'update'])->name('driver.update');
         Route::delete('/drivers/delete/{id}', [DriverController::class, 'destroy'])->name('driver.destroy');
           //END Drivers section all routes
             // Vehicle List Index start
    Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle.index');
      Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicle.create');
       Route::POST('/vehicle/store', [VehicleController::class, 'store'])->name('vehicle.store');
        Route::get('/vehicle/show/{id}', [VehicleController::class, 'show'])->name('vehicle.show');
         Route::get('/vehicle/edit/{id}', [VehicleController::class, 'edit'])->name('vehicle.edit');
          Route::PUT('/vehicle/update/{id}', [VehicleController::class, 'update'])->name('vehicle.update');
           Route::DELETE('/vehicle/destroy/{id}', [VehicleController::class, 'destroy'])->name('vehicle.destroy');
           // Vehicle List Index  END
              //Start assing vehicles
    Route::get('/assign/vehicle', [AssignVehicleController::class, 'index'])->name('assign_vehicle.index');
      Route::get('/assign/vehicle/create', [AssignVehicleController::class, 'create'])->name('assign_vehicle.create');
       Route::POST('/assign/vehicle/store', [AssignVehicleController::class, 'store'])->name('assign_vehicle.store');
        Route::get('/assign/vehicle/show/{id}', [AssignVehicleController::class, 'show'])->name('assign_vehicle.show');
         Route::get('/assign/vehicle/edit/{id}', [AssignVehicleController::class, 'edit'])->name('assign_vehicle.edit');
          Route::PUT('/assign/vehicle/update/{id}', [AssignVehicleController::class, 'update'])->name('assign_vehicle.update');
           Route::DELETE('/assign/vehicle/destroy/{id}', [AssignVehicleController::class, 'destroy'])->name('assign_vehicle.destroy');
           // End assign vehicles
           // START DEFECT ROUTES
            Route::get('/defects', [DefectController::class, 'index'])->name('defect.index');
            Route::get('admin/defects/{id}', [DefectController::class, 'show'])->name('defects.show');
            Route::delete('/admin/defects/{id}', [DefectController::class, 'destroy'])->name('defects.destroy');



            // END DEFECT ROUTES
      
      


   
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
