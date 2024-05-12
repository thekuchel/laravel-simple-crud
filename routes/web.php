<?php

use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\EmployeeController;
use App\Http\Controllers\Scenario\ScenarioController;
use App\Http\Controllers\Session\SessionController;
use App\Http\Controllers\ACL\UserController;
use App\Http\Controllers\Log\LogController;
use App\Http\Controllers\ProfileController;
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


Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/login', [CustomLoginController::class, 'index'])->name('login');
Route::post('/login', [CustomLoginController::class, 'login_proses']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        Route::post('/create', [EmployeeController::class, 'store'])->name('store');
        Route::get('/detail/{id}', [EmployeeController::class, 'show'])->name('detail');
        Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [EmployeeController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [EmployeeController::class, 'destroy'])->name('destroy');
        Route::get('/list-datatables', [EmployeeController::class, 'list_datatables'])->name('datatable'); // Export Data
        Route::get('/export', [EmployeeController::class, 'export'])->name('export');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/create', [UserController::class, 'create']);
        Route::get('/edit/{id}', [UserController::class, 'edit']);
        Route::get('/delete/{id}', [UserController::class, 'destroy']);
        Route::get('/datatables', [UserController::class, 'list_datatables_api']);
        /* Post section */
        Route::post('/create', [UserController::class, 'store']);
        Route::post('/edit/{id}', [UserController::class, 'update']);
    });

    Route::prefix('logs')->name('logs.')->group(function () {
        Route::get('/', [LogController::class, 'index'])->name('index');

        Route::get('/list-datatables', [LogController::class, 'list_datatables'])->name('datatable');
    });

    Route::get('/auth/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/auth/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/auth/profile-photo-update', [ProfileController::class, 'profile_photo_update'])->name('profile.photo.update');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
