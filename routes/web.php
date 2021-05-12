<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RentalController;
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

Route::view('/register','authentication/register');
Route::post('register',[UserController::class,'register']);

//---------------------------------------------------------------------------------------------------------

//-----------------------------------------login------------------------------------------------------------

Route::get('/', 'App\Http\Controllers\MainController@index');
Route::post('main/checklogin', 'App\Http\Controllers\MainController@checklogin');
Route::get('main/successlogin', 'App\Http\Controllers\MainController@successlogin');
Route::get('main/logout', 'App\Http\Controllers\MainController@logout');

//----------------------------------------------------------------------------------------------------------

//-------------------------------------------members--------------------------------------------------------

Route::get('/book_reservation',[ReservationController::class,'showBooks']);

Route::get('/myreservations',[ReservationController::class,'showMyReservations']);

Route::get('/myhistory',[RentalController::class,'showMyRentals']);

//----------------------------------------------------------------------------------------------------------

//-------------------------------------------common---------------------------------------------------------

Route::get('/data_update', function () {
    return view('/common/data_update');
});
Route::post('/edit',[UserController::class,'update']);

Route::get('/home', function () {
    return view('/common/home');
});

//----------------------------------------------------------------------------------------------------------

//-------------------------------------------employee-------------------------------------------------------

Route::get('books',[BookController::class,'showBooks']);
Route::get('delete/{id}',[BookController::class,'delete']);
Route::get('search1', 'App\Http\Controllers\BookController@search')->name('search1');

Route::view('/new_book','employee/new_book');
Route::post('/new_book',[BookController::class,'addBook']);

Route::get('/book_update', function () {
    return view('employee/book_update');
});

Route::get('/users',[UserController::class,'show']);
Route::get('search', 'App\Http\Controllers\UserController@search')->name('search');

Route::view('/new_user','employee/new_user');
Route::post('new_user',[UserController::class,'addData']);

Route::get('/rental',[RentalController::class,'showRentals']);

Route::get('/reservations',[ReservationController::class,'showReservations']);

//--------------------------------------------------------tests------------------------------------------------------

Route::get('/test', [StockController::class, 'showBooks']);



Route::get('send-mail','MailSend@mailsend');
