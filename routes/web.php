<?php

use App\Http\Controllers\adminInventoryController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\adminLoginController;
use App\Http\Controllers\adminLogsController;
use App\Http\Controllers\adminUserController;
use App\Http\Controllers\ioRecapController;
use App\Http\Controllers\stockOpnameController;
use App\Http\Controllers\userInventoryController;
use App\Http\Controllers\userItemController;
use App\Http\Controllers\userLoginController;
use App\Http\Controllers\viewInventoryController;
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

Route::get('/', [loginController::class, 'loginChoose'])->name('login');


// Admin Section
Route::get('/adminlogin', [adminLoginController::class, 'index'])->name('admin.login');

Route::post('/admin-login', [adminLoginController::class, 'authenticateAdmin'])->name('admin.authenticate');

Route::get('/dashboard', function () {
    return view('dashboardTabs');
})->name('dashboard');

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin-dashboard', [adminInventoryController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::get('/admin-inventory', [adminInventoryController::class, 'index'])->name('admin.inventory');
    Route::post('/add-item', [adminInventoryController::class, 'addItem'])->name('addItem');
    Route::get('/get-item/{itemId}', [adminInventoryController::class, 'getItem'])->name('getItem');
    Route::post('/edit-item/{itemId}', [adminInventoryController::class, 'editItem'])->name('editItem');
    Route::delete('/delete-item/{itemId}', [adminInventoryController::class, 'deleteItem'])->name('deleteItem');
    Route::get('/user-list', [adminUserController::class, 'index'])->name('admin.user');
    Route::post('/add-user', [adminUserController::class, 'addUser'])->name('addUser');
    Route::delete('/delete-user/{userId}', [adminUserController::class, 'deleteUser'])->name('deleteUser');
    Route::get('/logs', [adminLogsController::class, 'index'])->name('admin.logs');
    Route::get('/admin-log-filter', [AdminlogsController::class, 'index'])->name('admin.logFilter');
    Route::get('/export-logs', [adminLogsController::class, 'exportLogs'])->name('admin.exportLogs');
    Route::get('/stock-opname', [stockOpnameController::class, 'index'])->name('admin.opname');
    Route::post('/update-opname', [stockOpnameController::class, 'updateQuantities'])->name('admin.updateOpname');
    Route::get('/export-inventory', [adminInventoryController::class, 'exportInventory'])->name('admin.exportInventory');
});





// User Section

Route::get('/user-login-form', [userLoginController::class, 'index'])->name('user.loginForm');
Route::post('/user-authenticate', [userLoginController::class, 'authenticateUser'])->name('user.authenticate');

Route::middleware(['auth:user'])->group(function () {
    Route::get('/user-inventory', [userInventoryController::class, 'index'])->name('user.inventory');
    Route::get('/user-add-item-page', [userItemController::class, 'addItemView'])->name('user.additem');
    Route::get('/user-logs', [userItemController::class, 'showLogs'])->name('user.logs');
    Route::get('/user-log-filter', [UserItemController::class, 'showLogs'])->name('user.logFilter');
    Route::post('/update-quantities', [userItemController::class, 'updateQuantities'])->name('user.updateQuantities');
    Route::post('/user-logout', [userLoginController::class, 'logout'])->name('user.logout');
});




