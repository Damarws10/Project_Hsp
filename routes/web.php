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

Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile')->middleware('checkRole:superuser,admin,user');

Route::get('/search_kendaraan', [HomeController::class, 'search_kendaraan'])->name('search_kendaraan');

//untuk update profile
Route::post('/profile/update', [HomeController::class, 'profileUpdate'])->name('profileUpdate');
//untuk update password
Route::post('/profile/passwordUpdate', [HomeController::class, 'changePassword'])->name('changePassword');

Route::get('/transaksikendaraan', [HomeController::class, 'transaksikendaraan'])->name('transaksikendaraan')->middleware('checkRole:superuser,admin,user');
Route::get('/historikendaraan', [HomeController::class, 'historikendaraan'])->name('historikendaraan')->middleware('checkRole:superuser,admin,user');

//untuk post hitori
Route::post('/transaksikendaraan/create', [HomeController::class, 'store_transaksi'])->name('store_transaksi');
//untuk update
Route::post('/transaksikendaraan/update', [HomeController::class, 'update_transaksiKendaraan'])->name('update_transaksiKendaraan');
//untuk delete
Route::post('/transaksikendaraan/delete', [HomeController::class, 'deleteTransaksi'])->name('deleteTransaksi');

//Untuk approve persetujuan
Route::get('/transaksikendaraan/approvekendaraan/{id}', [HomeController::class,'approveKendaraan'])->name('approveKendaraan');
//untuk cancel Approve
Route::get('/transaksikendaraan/approvekendaraankembali/{id}', [HomeController::class,'approveKendaraankembali'])->name('approveKendaraankembali');

//detail kendaraan
Route::get('/detailkendaraan/{no_plat}', [HomeController::class,'detailkendaraan'])->name('detailkendaraan');

Route::get('/formuser', [HomeController::class, 'formuser'])->name('formuser')->middleware('checkRole:superuser');

//untuk post user
Route::post('/formuser/post', [HomeController::class, 'post'])->name('post');

Route::get('/informasiuser',[HomeController::class, 'informasiuser'])->name('informasiuser')->middleware('checkRole:superuser,admin');

//Untuk infouser
Route::post('/informasiuser/update', [HomeController::class, 'update'])->name('update');
//Delete User
Route::post('/informasiuser/delete', [HomeController::class, 'delete'])->name('delete');

Route::get('/formkendaraan',[HomeController::class, 'formkendaraan'])->name('formkendaraan')->middleware('checkRole:superuser,admin');

//untuk post Kendaraan
Route::post('/formkendaraan/store', [HomeController::class, 'store_kendaraan'])->name('store_kendaraan');

Route::get('/informasikendaraan',[HomeController::class, 'informasikendaraan'])->name('informasikendaraan')->middleware('checkRole:superuser,admin,user');

//data tanggal kendaraan
Route::get('show-tgl', [HomeController::class, 'show']);

//Update Kendaraan
Route::post('/informasikendaraan/update', [HomeController::class, 'update_kendaraan'])->name('update_kendaraan');
//Delete Kendaraan
Route::post('/informasikendaraan/delete', [HomeController::class, 'delete_kendaraan'])->name('delete_kendaraan');