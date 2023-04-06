<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\DependencyInjection\ServicesResetter;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('services', [ServiceController::class, 'index'])->name('services')->middleware('can:view service');
    Route::get('add-service', [ServiceController::class, 'create'])->name('add-service')->middleware('can:create service');
    Route::post('store-service', [ServiceController::class, 'store'])->name('store-service')->middleware('can:create service');
    Route::get('edit-service/{id}', [ServiceController::class, 'edit'])->name('edit-service')->middleware('can:update service');
    Route::post('update-service/{id}', [ServiceController::class, 'update'])->name('update-service')->middleware('can:update service');
    Route::get('delete-service/{id}', [ServiceController::class, 'delete'])->name('delete-service')->middleware('can:delete service');

    Route::get('roles', [RoleController::class, 'index'])->name('roles')->middleware('can:view role');
    Route::get('add-role', [RoleController::class, 'create'])->name('add-role')->middleware('can:create role');
    Route::get('store-role', [RoleController::class, 'store'])->name('store-role')->middleware('can:create role');
    Route::get('edit-role/{id}', [RoleController::class, 'edit'])->name('edit-role')->middleware('can:update role');
    Route::post('update-role/{id}', [RoleController::class, 'update'])->name('update-role')->middleware('can:update role');
    Route::get('delete-role/{id}', [RoleController::class, 'delete'])->name('delete-role')->middleware('can:delete role');

    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions')->middleware('can:view permission');
    Route::get('add-permission', [PermissionController::class, 'create'])->name('add-permission')->middleware('can:create permission');
    Route::get('store-permission', [PermissionController::class, 'store'])->name('store-permission')->middleware('can:create permission');
    Route::get('edit-permission/{id}', [PermissionController::class, 'edit'])->name('edit-permission')->middleware('can:update permission');
    Route::post('update-permission/{id}', [PermissionController::class, 'update'])->name('update-permission')->middleware('can:update permission');
    Route::get('delete-permission/{id}', [PermissionController::class, 'delete'])->name('delete-permission')->middleware('can:delete permission');

    Route::resource('users', UserController::class)->middleware('role:super-user');

});


require __DIR__.'/auth.php';
