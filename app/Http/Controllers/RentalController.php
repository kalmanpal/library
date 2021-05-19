<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    //
    function showRentals()
    {
        $data = DB::table('rentals')->join('stocks', 'rentals.isbn', "=", 'stocks.isbn')->join('users', 'rentals.email', "=", 'users.email')->get();
        return view('employee/rental', ['rentals' => $data]);
    }

    function showMyRentals()
    {
        $data = DB::table('rentals')->join('stocks', 'rentals.isbn', "=", 'stocks.isbn')->join('books', 'stocks.isbn', "=", 'books.isbn')->where('email', '=', Auth::user()->email)->get();
        return view('member/rental_history', ['rentals' => $data]);
    }

    function rentFromRes($id)
    {
        $res = Reservation::find($id);
        $rent = new Rental();
        $rent->out_date = Carbon::today();
        //$rent->deadline = Carbon::today()->addMonth(2);

        $seged = DB::table('reservations')
            ->join('users', 'reservations.email', "=", 'users.email')
            ->get();

        $type = $seged[0]->type;

        if ($type == "EH") {
            $rent->deadline = Carbon::today()->addMonth(2);
        }else

        if ($type == "EO") {
            $rent->deadline = Carbon::today()->addYear(1);
        }else

        if ($type == "ME") {
            $rent->deadline = Carbon::today()->addMonth(1);
        }else

        if ($type == "E") {
            $rent->deadline = Carbon::today()->addDays(14);
        }

        $rent->isbn = $res->isbn;
        $rent->email = $res->email;
        $rent->save();
        $res->delete();
        return redirect('/rental');
    }
}
