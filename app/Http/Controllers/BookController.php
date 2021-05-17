<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

    function showBooks()
    {
        $data = DB::table('books')->join('stocks', 'books.isbn', "=", 'stocks.isbn')->get();
        return view('employee/books', ['books' => $data]);
    }


    function delete($id)
    {
        $data = Stock::find($id);
        $data->max_number = "0";
        $data->number = "0";
        $data->save();
        return redirect('/books');
    }

    function addBook(Request $req)
    {
        $book = new Book;
        $book->title = $req->title;
        $book->writer = $req->writer;
        $book->publisher = $req->publisher;
        $book->year = $req->year;
        $book->edition = $req->edition;
        $book->isbn = $req->isbn;
        $book->save();
        $stock = new Stock;
        $stock->max_number = $req->max_number;
        $stock->number = $req->max_number;
        $stock->isbn = $req->isbn;
        $stock->save();
        return redirect('/books');
    }

    function search1(Request $request){
        // Get the search value from the request
        $search1 = $request->input('search1');

        // Search in the title and body columns from the posts table
        $books = Book::query()
            ->where('title', 'LIKE', "%{$search1}%")
            ->get();

        // Return the search view with the resluts compacted
        return view('employee/books', compact('books'));
    }


}
