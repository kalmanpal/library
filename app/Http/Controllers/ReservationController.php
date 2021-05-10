<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use App\Models\Book;


class ReservationController extends Controller
{

    function showReservations()
    {
        $data = DB::table('reservations')->join('books', 'reservations.isbn', "=", 'books.isbn')->join('users','reservations.email', "=", 'users.email')->get();
        return view('employee/reservations', ['reservations' => $data]);
    }

    function showBooks()
    {
        $data = DB::table('books')->join('stocks', 'books.isbn', "=", 'stocks.isbn')->get();
        return view('member/book_reservation ', ['books' => $data]);
    }

}
