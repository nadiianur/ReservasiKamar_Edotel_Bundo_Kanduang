<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TransactionController;
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


//landing page
Route::get('/', function () {
    return view('welcome');
});

//login
Route::get('/signIn', [AuthController::class, 'getSignIn'])->name('signIn');
Route::post('/auth/signIn', [AuthController::class, 'signIn']);

//register
Route::get('/signUp', [AuthController::class, 'getSignUp']);
Route::post('/auth/signUp', [AuthController::class, 'store']);

//dashboard
Route::get('/dashboard', [RoomController::class, 'dashboard']);

//rooms
Route::middleware(['admin'])->group(function () {
    Route::get('/rooms', [RoomController::class, 'index']);
});
Route::middleware(['admin'])->group(function () {
    Route::post('/rooms/add', [RoomController::class, 'store'])->name('rooms.add');
});
Route::middleware(['admin'])->group(function () {
    Route::put('/rooms/{id_kamar}/edit', [RoomController::class, 'update'])->name('rooms.update');
});
Route::middleware(['admin'])->group(function () {
    Route::delete('/rooms/{id_kamar}/delete', [RoomController::class, 'destroy'])->name('rooms.destroy');
});

//transactions
Route::middleware(['admin'])->group(function(){
    Route::get('/transactions', [TransactionController::class, 'index']);
});
Route::middleware(['admin'])->group(function () {
    Route::put('/transactions/{id_transaksi}/verify', [TransactionController::class, 'verify'])->name('transactions.verify');
});
Route::middleware(['admin'])->group(function () {
    Route::delete('/transactions/{id_transaksi}/delete', [TransactionController::class, 'destroy'])->name('transactions.destroy');
});
Route::get('/booking', [TransactionController::class, 'show']);
Route::get('/booking/add/{id_kamar}', [TransactionController::class, 'showStore'])->name('booking.showStore');
Route::post('/booking/add', [TransactionController::class, 'store'])->name('booking.add')->middleware(('auth.user'));
