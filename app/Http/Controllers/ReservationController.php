<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Stock;
use Carbon\Carbon;


class ReservationController extends Controller
{

    function showReservations()
    {
        $data = DB::table('reservations')->join('books', 'reservations.isbn', "=", 'books.isbn')->join('users','reservations.email', "=", 'users.email')->get();
        return view('employee/reservations', ['reservations' => $data]);
    }

    function showBooks()
    {
        $data = DB::table('books')->join('stocks', 'books.isbn', "=", 'stocks.isbn')->where('number', '>', 0)->get();
        return view('member/book_reservation ', ['books' => $data]);
    }

    function showMyReservations()
    {
        $data = DB::table('reservations')->join('stocks', 'reservations.isbn', "=", 'stocks.isbn')->join('users','reservations.email', "=", 'users.email')->where('email', '=', Auth::user()->email)->get();
        return view('member/myreservations', ['reservations' => $data]);
    }


}
