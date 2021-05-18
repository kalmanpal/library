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
        $rent->deadline = Carbon::today()->addMonth(2);

        // if ($res->type == "EH") {
        //     $rent->deadline = $rent->out_date->addDays(60);
        // }else

        // if ($res->type == "EO") {
        //     $rent->deadline = $rent->out_date->addDays(365);
        // }else

        // if ($res->type == "ME") {
        //     $rent->deadline = $rent->out_date->addDays(30);
        // }else

        // if ($res->type == "E") {
        //     $rent->deadline = $rent->out_date->addDays(14);
        // }

        $rent->isbn = $res->isbn;
        $rent->email = $res->email;
        $rent->save();
        $res->delete();
        return redirect('/rental');
    }
}
