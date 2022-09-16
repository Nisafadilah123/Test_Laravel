<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard_user', function () {
//     return view('Dashbard_user');
// })->middleware(['user_type: user'])->name('dashboard');

Route::middleware(['auth:web', 'user_type:admin'])->group(function(){
    Route::get('/dashboard_admin', [AdminController::class, 'dashboard']);
    Route::resource('/companies', CompaniesController::class);
    Route::resource('/employees', EmployeesController::class);

});

// Route::middleware(['auth:web', 'user_type:user'])->group(function(){
//     Route::get('/dashboard_user', [AdminController::class, 'dashboard_user']);
// });
    Route::get('/dashboard_user', [AdminController::class, 'dashboard_user']);

require __DIR__.'/auth.php';
