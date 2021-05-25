<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
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


    function plusOneBook($id)
    {
        $data = Stock::find($id);

        $plusOne = $data->number + 1;
        $plusOne2 = $data->max_number + 1;

        $data->number = $plusOne;
        $data->max_number = $plusOne2;

        $data->save();

        session(['plusbook' => 'A könyv száma módosult!(+1)!']);

        return redirect('/books');
    }

    function minusOneBook($id)
    {
        $data = Stock::find($id);

        $minusOne = $data->number - 1;
        $minusOne2 = $data->max_number - 1;

        if($data->max_number == 0)
        {
            session(['minusbook' => 'Ebből a könyvből már nincs készleten, ezért a módosítás nem hajtható végre!']);
        }
        elseif($data->number == 0)
        {
            session(['minusbook' => 'Ebből a könyvből az összes kölcsönözve van, ezért nem végrehajtható a módosítás!']);
        }
        else
        {
            $data->number = $minusOne;
            $data->max_number = $minusOne2;

            $data->save();

            session(['minusbook' => 'A könyv száma módosult(-1)!']);
        }

        return redirect('/books');
    }


}
