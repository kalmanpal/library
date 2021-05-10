<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockController;

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

//----------------------------------------register---------------------------------------------------------

Route::get('/register', function () {
    return view('authentication/register');
});

//---------------------------------------------------------------------------------------------------------

//-----------------------------------------login------------------------------------------------------------

Route::get('/', 'App\Http\Controllers\MainController@index');
Route::post('main/checklogin', 'App\Http\Controllers\MainController@checklogin');
Route::get('main/successlogin', 'App\Http\Controllers\MainController@successlogin');
Route::get('main/logout', 'App\Http\Controllers\MainController@logout');

//----------------------------------------------------------------------------------------------------------

//-------------------------------------------members--------------------------------------------------------

Route::get('/book_reservation',[ReservationController::class,'showBooks']);

Route::get('/myreservations', function () {
    return view('/member/myreservations');
});

Route::get('/myhistory', function () {
    return view('/member/rental_history');
});

//----------------------------------------------------------------------------------------------------------

//-------------------------------------------common---------------------------------------------------------

Route::get('/data_update', function () {
    return view('/common/data_update');
});

Route::get('/home', function () {
    return view('/common/home');
});

//----------------------------------------------------------------------------------------------------------

//-------------------------------------------employee-------------------------------------------------------

Route::get('books',[BookController::class,'showBooks']);
Route::get('delete/{id}',[BookController::class,'delete']);

Route::view('/new_book','employee/new_book');
Route::post('new_book',[BookController::class,'addData']);

Route::get('/book_update', function () {
    return view('employee/book_update');
});

Route::get('/users',[UserController::class,'show']);

Route::view('/new_user','employee/new_user');
Route::post('new_user',[UserController::class,'addData']);

Route::get('/rental', function () {
    return view('employee/rental');
});

Route::get('/reservations',[ReservationController::class,'showReservations']);

//--------------------------------------------------------tests------------------------------------------------------

Route::get('/test', [StockController::class, 'showBooks']);

