<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    //
    function showRentals()
    {
        $data = DB::table('rentals')->join('stocks', 'rentals.isbn', "=", 'stocks.isbn')->join('users','rentals.email', "=", 'users.email')->get();
        return view('employee/rental', ['rentals' => $data]);
    }



}
