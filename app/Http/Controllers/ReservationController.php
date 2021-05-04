<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Book;

class ReservationController extends Controller
{

    function show()
    {
        $data = Reservation::all();
        return view('employee/reservations', ['reservations' => $data]);
    }

    function showBooks()
    {
        $data = Book::all();
        return view('member/book_reservation', ['books' => $data]);
    }

}
