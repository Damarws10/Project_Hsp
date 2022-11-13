<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('checkRole:superuser');
// Route::get('/datauser', [HomeController::class, 'datauser'])->name('user.home')->middleware('checkRole:superuser');
// Route::get('/datakendaraan', [HomeController::class, 'datakendaraan'])->name('kendaraan.home')->middleware('checkRole:admin');

// Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/datauser', [HomeController::class, 'datauser'])->name('user.home');
// Route::get('/datakendaraan', [HomeController::class, 'datakendaraan'])->name('kendaraan.home');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

Route::get('/historikendaraan', [HomeController::class, 'historikendaraan'])->name('historikendaraan')->middleware('checkRole:superuser');
//untuk post hitori
Route::post('/historikendaraan/create', [HomeController::class, 'store_transaksi'])->name('store_transaksi');
//untuk update
Route::post('/historikendaraan/update', [HomeController::class, 'update_transaksiKendaraan'])->name('update_transaksiKendaraan');
//untuk delete
Route::post('/historikendaraan/delete', [HomeController::class, 'deleteTransaksi'])->name('deleteTransaksi');


Route::get('/formuser', [HomeController::class, 'formuser'])->name('formuser')->middleware('checkRole:superuser');

//untuk post user
Route::post('/formuser/post', [HomeController::class, 'post'])->name('post');

Route::get('/informasiuser',[HomeController::class, 'informasiuser'])->name('informasiuser')->middleware('checkRole:superuser');

//Untuk infouser
Route::post('/informasiuser/update', [HomeController::class, 'update'])->name('update');
//Delete User
Route::post('/informasiuser/delete', [HomeController::class, 'delete'])->name('delete');

Route::get('/formkendaraan',[HomeController::class, 'formkendaraan'])->name('formkendaraan')->middleware('checkRole:superuser');

//untuk post Kendaraan
Route::post('/formkendaraan/store', [HomeController::class, 'store_kendaraan'])->name('store_kendaraan');

Route::get('/informasikendaraan',[HomeController::class, 'informasikendaraan'])->name('informasikendaraan')->middleware('checkRole:superuser');
//Update Kendaraan
Route::post('/informasikendaraan/update', [HomeController::class, 'update_kendaraan'])->name('update_kendaraan');
//Delete Kendaraan
Route::post('/informasikendaraan/delete', [HomeController::class, 'delete_kendaraan'])->name('delete_kendaraan');