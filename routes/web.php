<?php

use App\Http\Controllers\PenerimahibahController;
use App\Http\Controllers\Permission_groupController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TahunanggaranController;
use App\Http\Controllers\UserController;
use App\Models\Penerimahibah;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Setings
    //Role
    Route::controller(RoleController::class)->group(function () {
        Route::get('/roles', 'index')->name('roles.index');
        Route::get('/roles/create', 'create')->name('roles.create');
        Route::post('/roles', 'store')->name('roles.store');
        Route::get('/roles/{id}/edit', 'edit')->name('roles.edit');
        Route::put('/roles/{id}/update', 'update')->name('roles.update');
        Route::delete('/roles/{id}/delete', 'destroy')->name('roles.delete');
        Route::get('/roles/{id}/createrolepermission', 'createrolepermission')->name('roles.createrolepermission');
        Route::post('/roles/{id}/storerolepermission', 'storerolepermission')->name('roles.storerolepermission');
    });


    Route::controller(Permission_groupController::class)->group(function () {
        Route::get('/permissiongroups', 'index')->name('permissiongroups.index');
        Route::get('/permissiongroups/create', 'create')->name('permissiongroups.create');
        Route::post('/permissiongroups', 'store')->name('permissiongroups.store');
        Route::get('/permissiongroups/{id}/edit', 'edit')->name('permissiongroups.edit');
        Route::put('/permissiongroups/{id}/update', 'update')->name('permissiongroups.update');
        Route::delete('/permissiongroups/{id}/delete', 'destroy')->name('permissiongroups.delete');
    });


    Route::controller(PermissionController::class)->group(function () {
        Route::get('/permissions', 'index')->name('permissions.index');
        Route::get('/permissions/create', 'create')->name('permissions.create');
        Route::post('/permissions', 'store')->name('permissions.store');
        Route::get('/permissions/{id}/edit', 'edit')->name('permissions.edit');
        Route::put('/permissions/{id}/update', 'update')->name('permissions.update');
        Route::delete('/permissions/{id}/delete', 'destroy')->name('permissions.delete');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users.index');
        Route::get('/users/create', 'create')->name('users.create');
        Route::post('/users', 'store')->name('users.store');
        Route::get('/users/{id}/edit', 'edit')->name('users.edit');
        Route::put('/users/{id}/update', 'update')->name('users.update');
        Route::delete('/users/{id}/delete', 'destroy')->name('users.delete');
    });

    Route::controller(PenerimahibahController::class)->group(function () {
        Route::get('/penerimahibah', 'index')->name('penerimahibah.index');
        Route::get('/penerimahibah/{kode_penerimahibah}/show', 'show')->name('penerimahibah.show');
        Route::get('/penerimahibah/create', 'create')->name('penerimahibah.create');
        Route::post('/penerimahibah', 'store')->name('penerimahibah.store');
        Route::get('/penerimahibah/{kode_penerimahibah}/edit', 'edit')->name('penerimahibah.edit');
        Route::put('/penerimahibah/{kode_penerimahibah}/update', 'update')->name('penerimahibah.update');
        Route::delete('/penerimahibah/{kode_penerimahibah}/delete', 'destroy')->name('penerimahibah.delete');
    });

    Route::controller(TahunanggaranController::class)->group(function () {
        Route::get('/tahunanggaran', 'index')->name('tahunanggaran.index');
        Route::get('/tahunanggaran/create', 'create')->name('tahunanggaran.create');
        Route::post('/tahtahunanggaranunaggaran', 'store')->name('tahunanggaran.store');
        Route::get('/tahunanggaran/{kode_anggaran}/edit', 'edit')->name('tahunanggaran.edit');
        Route::put('/tahunanggaran/{id}/update', 'update')->name('tahunanggaran.update');
        Route::delete('/tahunanggaran/{id}/delete', 'destroy')->name('tahunanggaran.delete');
    });


    Route::controller(ProposalController::class)->group(function () {
        Route::get('/proposal', 'index')->name('proposal.index');
        Route::get('/proposal/{kode_penerimahibah}/create', 'create')->name('proposal.create');
        Route::post('/proposal', 'store')->name('proposal.store');
        Route::get('/proposal/{kode_anggaran}/edit', 'edit')->name('proposal.edit');
        Route::put('/proposal/{id}/update', 'update')->name('proposal.update');
        Route::delete('/proposal/{id}/delete', 'destroy')->name('proposal.delete');
    });
});


Route::get('/createrolepermission', function () {

    try {
        Role::create(['name' => 'super admin']);
        // Permission::create(['name' => 'view-karyawan']);
        // Permission::create(['name' => 'view-departemen']);
        echo "Sukses";
    } catch (\Exception $e) {
        echo "Error";
    }
});

require __DIR__ . '/auth.php';
