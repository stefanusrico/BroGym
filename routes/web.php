<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\TrainerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});


Auth::routes();

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('admin', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('user', 'UserController@dashboard')->name('user.dashboard');
    // Add more routes based on roles
});

Route::group(['prefix' => 'dashboard/admin', 'middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [HomeController::class, 'profile'])->name('profile');
        Route::post('update', [HomeController::class, 'updateprofile'])->name('profile.update');
    });

    Route::controller(RoleController::class)
        ->prefix('roles')
        ->as('roles.')
        ->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::get('/create', [RoleController::class, 'create'])->name('create');
            Route::post('/store', [RoleController::class, 'store'])->name('store');
            Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
            Route::put('/{role}', [RoleController::class, 'update'])->name('update');
            Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
        });

    Route::controller(AkunController::class)
        ->prefix('akun')
        ->as('akun.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            // Route::post('showdata', 'dataTable')->name('dataTable');
            Route::post('showdata', 'dataTable')->name('dataTable');
            Route::match(['get', 'post'], 'tambah', 'tambahAkun')->name('add');
            Route::match(['get', 'post'], '{id}/ubah', 'ubahAkun')->name('edit');
            Route::delete('{id}/hapus', 'hapusAkun')->name('delete');
            Route::get('/akun/export', [AkunController::class, 'export'])->name('export');
            Route::post('/akun/import', [AkunController::class, 'import'])->name('import');
        });

    Route::controller(MembershipController::class)
        ->prefix('membership')
        ->as('membership.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/showdata', [MembershipController::class, 'showdata'])->name('showdata');
            Route::post('/store', [MembershipController::class, 'store'])->name('store');
            Route::post('showdata', 'getDataMember')->name('getDataMember');
            Route::match(['get', 'post'], '{id}/ubah', 'ubahStatus')->name('edit');
            Route::match(['get', 'delete'], '{id}/hapus', 'hapusMember')->name('delete');
        });

    Route::controller(TrainerController::class)
        ->prefix('trainers')
        ->as('trainers.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/showdata', [TrainerController::class, 'showdata'])->name('showdata');

            Route::post('showdata', 'getDataTrainer')->name('getDataTrainer');
            Route::match(['get', 'post'], '{id}/ubah', 'ubahStatus')->name('edit');
            Route::match(['get', 'delete'], '{id}/hapus', 'hapusMember')->name('delete');
        });
});

Route::group(['prefix' => 'dashboard/user', 'middleware' => 'auth'], function () {
    Route::get('/', [UserController::class, 'index'])->name('homa');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [UserController::class, 'profile'])->name('profile');
        Route::post('update', [UserController::class, 'updateprofile'])->name('profile.update');
    });

    Route::controller(UserController::class)
        ->prefix('user')
        ->as('user.')
        ->group(function () {
            // Route::get('/', 'index')->name('index');
            Route::post('<pembayaran></pembayaran>', [UserController::class, 'berlangganan'])->name('pembayaran');
            // Route::match(['get', 'post'], 'tambah', 'tambahAkun')->name('add');
            // Route::match(['get', 'post'], '{id}/ubah', 'ubahAkun')->name('edit');
            // Route::delete('{id}/hapus', 'hapusAkun')->name('delete');

        });

    Route::controller(MembershipController::class)
        ->prefix('membership')
        ->as('membership.')
        ->group(function () {
            Route::get('/daftar', [MembershipController::class, 'daftar'])->name('daftar');
        });
});
