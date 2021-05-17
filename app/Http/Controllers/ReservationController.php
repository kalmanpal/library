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
        $data = DB::table('reservations')->join('books', 'reservations.isbn', "=", 'books.isbn')->join('users','reservations.email', "=", 'users.email')->orderBy('reservations.created_at', 'asc')->get();
        return view('employee/reservations', ['reservations' => $data]);
    }

    function showBooks()
    {
        $data = DB::table('stocks')->join('books', 'stocks.isbn', "=", 'books.isbn')->where('stocks.number', '>', 0)->get();
        return view('member/book_reservation ', ['books' => $data]);
    }

    function showMyReservations()
    {
        $data = DB::table('reservations')->join('stocks', 'reservations.isbn', "=", 'stocks.isbn')->join('books', 'stocks.isbn', "=", 'books.isbn')->join('users','reservations.email', "=", 'users.email')->where('reservations.email', '=', Auth::user()->email)->get();
        return view('member/myreservations', ['myreservations' => $data]);
    }

    function reserve($id)
    {
        $stock = Stock::find($id);
        $res = new Reservation;
        $res->date = Carbon::today();
        $res->expiry = Carbon::tomorrow();
        $res->email = Auth::user()->email;
        $res->isbn = $stock->isbn;
        $res->save();
        $stock->number = $stock->number-1;
        $stock->save();
        return redirect('/book_reservation');
    }

    function deleteReservation($id)
    {
        $data = Reservation::find($id);
        $data->delete();
        return redirect('/myreservations');
    }



}
