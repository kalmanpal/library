<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{

    function show()
    {
        $data = Book::all();
        return view('employee/books', ['books' => $data]);
    }
    function delete($id)
    {
        $data = Book::find($id);
        $data->delete();
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

}
