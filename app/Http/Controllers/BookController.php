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
        $data->delete();
        $data2 = Book::find($id);
        $data2->delete();
        return redirect('/books');
    }

    function addData(Request $req)
    {
        $book = new Book;
        $book-> title=$req->title;
        $book-> writer=$req->writer;
        $book-> publisher=$req->publisher;
        $book-> year=$req->year;
        $book-> edition=$req->edition;
        $book-> isbn=$req->isbn;
        $book-> save();
        return redirect('/books');
    }

    function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
    
        // Search in the title and body columns from the posts table
        $books = Book::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('employee/books', compact('books'));
    }

}
