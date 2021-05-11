<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    //
    function showRentals()
    {
        $data = DB::table('rentals')->join('stocks', 'rentals.isbn', "=", 'stocks.isbn')->join('users','rentals.email', "=", 'users.email')->get();
        return view('employee/rental', ['rentals' => $data]);
    }

    function showMyRentals()
    {
        $data = DB::table('rentals')->join('stocks', 'rentals.isbn', "=", 'stocks.isbn')->join('books', 'stocks.isbn', "=", 'books.isbn')->where('email', '=', Auth::user()->email)->get();
        return view('member/rental_history', ['rentals' => $data]);
    }



}
