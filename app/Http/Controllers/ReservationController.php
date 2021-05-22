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
        $data = DB::table('reservations')
            ->join('books', 'reservations.isbn', "=", 'books.isbn')
            ->join('users', 'reservations.email', "=", 'users.email')
            ->select('title', 'name', 'reservations.isbn', 'expiry', 'reservations.id')
            ->orderBy('reservations.expiry', 'asc')
            ->get();
        return view('employee/reservations', ['reservations' => $data]);
    }

//---------------------------------------------------------------------------------------------------------------------------------

    function showBooks()
    {
        $data = DB::table('stocks')->join('books', 'stocks.isbn', "=", 'books.isbn')
            ->where('stocks.number', '>', 0)
            ->orderBy('title', 'asc')
            ->get();
        return view('member/book_reservation ', ['books' => $data]);
    }

//---------------------------------------------------------------------------------------------------------------------------------

    function showMyReservations()
    {
        $data = DB::table('reservations')
            ->join('stocks', 'reservations.isbn', "=", 'stocks.isbn')
            ->join('books', 'stocks.isbn', "=", 'books.isbn')
            ->join('users', 'reservations.email', "=", 'users.email')
            ->where('reservations.email', '=', Auth::user()->email)
            ->select('title', 'writer', 'reservations.isbn', 'year', 'expiry', 'reservations.id')
            ->orderBy('expiry', 'asc')
            ->get();
        return view('member/myreservations', ['myreservations' => $data]);
    }

//---------------------------------------------------------------------------------------------------------------------------------

    function reserve($id)
    {
        $user = DB::table('users')
            ->where('users.email', "=", Auth::user()->email)
            ->get();

        $current = $user[0]->current;
        $max = $user[0]->max;

        $stock = Stock::find($id);
        $res = new Reservation;
        $res->date = Carbon::today();
        $res->expiry = Carbon::tomorrow();
        $res->email = Auth::user()->email;
        $res->isbn = $stock->isbn;
        if ($current < $max) {
            $res->save();

            $userToSave = DB::table('users')
                ->where('users.email', Auth::user()->email)
                ->update(['current' => $current + 1]);

            $stock->number = $stock->number - 1;
            $stock->save();
            session(['res' => 'Foglalás Sikeres!']);
        } else {
            session(['res' => 'Egyszerre nem foglalhatsz, vagy kölcsönözhetsz több könyvet!']);
        }

        return redirect('/book_reservation');
    }

//---------------------------------------------------------------------------------------------------------------------------------

    function deleteReservation($id)
    {
        $res = Reservation::find($id);

        $user = DB::table('users')
            ->where('users.email', "=", Auth::user()->email)
            ->get();

        $current = $user[0]->current;
        $max = $user[0]->max;

        $seged = DB::table('stocks')
            ->join('reservations', 'stocks.isbn', "=", 'reservations.isbn')
            ->where('stocks.isbn', '=', $res->isbn)
            ->get();

        $number = $seged[0]->number;

        $stock = DB::table('stocks')
            ->where('stocks.isbn', $res->isbn)
            ->update(['number' => $number + 1]);

        $userToSave = DB::table('users')
            ->where('users.email', Auth::user()->email)
            ->update(['current' => $current - 1]);

        $res->delete();

        session(['deleteres' => 'Foglalás törölve!']);

        return redirect('/myreservations');
    }
}
