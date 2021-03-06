<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use App\Models\User;
use App\Models\Book;

class RentalController extends Controller
{
    //
    function showRentals()
    {

        $data = DB::table('rentals')
            ->join('stocks', 'rentals.isbn', "=", 'stocks.isbn')
            ->join('users', 'rentals.email', "=", 'users.email')
            ->select('name', 'out_date', 'rentals.isbn', 'deadline', 'rentals.id', 'in_date')
            ->orderBy('rentals.in_date', 'asc')
            ->get();
        return view('employee/rental', ['rentals' => $data]);
    }

    //----------------------------------------------------------------------------------------------------------------------------------

    function showMyRentals()
    {

        $data = DB::table('rentals')
            ->join('stocks', 'rentals.isbn', "=", 'stocks.isbn')
            ->join('books', 'stocks.isbn', "=", 'books.isbn')
            ->where('email', '=', Auth::user()->email)
            ->orderBy('in_date', 'asc')
            ->get();
        return view('member/rental_history', ['rentals' => $data]);
    }

    //----------------------------------------------------------------------------------------------------------------------------------

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
        } else

        if ($type == "EO") {
            $rent->deadline = Carbon::today()->addYear(1);
        } else

        if ($type == "ME") {
            $rent->deadline = Carbon::today()->addMonth(1);
        } else

        if ($type == "E") {
            $rent->deadline = Carbon::today()->addDays(14);
        }

        $rent->isbn = $res->isbn;
        $rent->email = $res->email;
        $rent->save();
        $res->delete();

        session(['rentfromres' => 'A k??nyv kik??lcs??n??zve!']);

        return redirect('/rental');
    }

    //----------------------------------------------------------------------------------------------------------------------------------

    function rent(Request $req, $id)
    {


        $stock = Stock::find($id);
        $rent = new Rental();
        $rent->out_date = Carbon::today();
        $rent->isbn = $stock->isbn;
        $email = $req->email;
        $rent->email = $email;

        $user = DB::table('users')
            ->where('email', "=", $email)
            ->get();

        $type = $user[0]->type;
        $current = $user[0]->current;
        $max = $user[0]->max;

        if ($type == "EH") {
            $rent->deadline = Carbon::today()->addMonth(2);
        } else

        if ($type == "EO") {
            $rent->deadline = Carbon::today()->addYear(1);
        } else

        if ($type == "ME") {
            $rent->deadline = Carbon::today()->addMonth(1);
        } else

        if ($type == "E") {
            $rent->deadline = Carbon::today()->addDays(14);
        }


        if ($user == null) {
            session(['rent' => 'Nincs ilyen felhaszn??l?? regisztr??lva!']);
        } elseif (($current < $max) && ($stock->number > 0)) {
            $rent->save();

            $userToSave = DB::table('users')
                ->where('users.email', $email)
                ->update(['current' => $current + 1]);

            $stock->number = $stock->number - 1;
            $stock->save();
            session(['successfulrent' => 'K??lcs??nz??s Sikeres!']);
            return redirect('/rental');
        } else {
            session(['rent' => 'A k??lcs??nz??s sikertelen! (A felhaszn??l?? el??rte a limitet vagy az adott k??nyv nem el??rhet??)']);
            return redirect('/books');
        }
        
    }


    //----------------------------------------------------------------------------------------------------------------------------------

    function bookBack($id)
    {

        $rent = Rental::find($id);
        $rent->in_date = Carbon::today();
        $email = $rent->email;
        $rent->save();

        $user = DB::table('users')
            ->where('users.email', "=", $email)
            ->get();

        $current = $user[0]->current;
        $max = $user[0]->max;

        $userToSave = DB::table('users')
            ->where('users.email', $email)
            ->update(['current' => $current - 1]);

        $seged = DB::table('stocks')
            ->join('rentals', 'stocks.isbn', "=", 'rentals.isbn')
            ->where('rentals.isbn', '=', $rent->isbn)
            ->get();

        $number = $seged[0]->number;

        $stock = DB::table('stocks')
            ->where('stocks.isbn', $rent->isbn)
            ->update(['number' => $number + 1]);

        session(['bookback' => 'A k??nyv visszahozva!']);

        return redirect('/rental');
    }
}
