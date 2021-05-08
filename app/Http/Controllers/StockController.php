<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{

    function showBooks()
    {
        $data = DB::table('books')->join('stocks', 'books.isbn', "=", 'stocks.isbn')->get();
        return view('employee/test', ['data' => $data]);
    }


    function showStock()
    {
        $data = DB::table('stocks')->get();
        return view('employee/test', ['stock' => $data]);
    }

}
