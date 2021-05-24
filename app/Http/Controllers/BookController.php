<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\UserController;

class BookController extends Controller
{

    function showBooks()
    {
        $data = DB::table('books')->join('stocks', 'books.isbn', "=", 'stocks.isbn')
        ->orderBy('title', 'asc')
        ->get();
        return view('employee/books', ['books' => $data]);
    }

    function delete($id)
    {
        $data = Stock::find($id);
        if($data->number == $data->max_number)
        {
            $data->max_number = "0";
            $data->number = "0";
            $data->save();
            session(['deletebook' => 'Sikeres törlés!']);
        }
        else
        {
            session(['deletebook' => 'Kikölcsönzött könyvet nem lehet törölni!']);
        }
            return redirect('/books');
    }

    function addBook(Request $req)
    {
         # check user if match with database user
         $books = Book::where('isbn', $req->isbn)->get();

         # check if email is more than 1
         if(sizeof($books) > 0){
             # tell user not to duplicate same email
             $msg = 'Ezzel az isbn-el van már könyv felvéve';
             session(['isbnExistError' => $msg]);
             return back();
         }


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

        session(['newbook' => 'A könyv bekerült a rendszerbe!']);

        return redirect('/books');
    }


    //---------------book search----------------

    function search1(Request $request){
        // Get the search value from the request
        $search1 = $request->input('search1');

        // Search in the title and body columns from the posts table
        $books = Book::query()
            ->where('title', 'LIKE', "%{$search1}%")
            ->join('stocks', 'books.isbn', "=", 'stocks.isbn')
            ->get();

        // Return the search view with the resluts compacted
        return view('employee/books', compact('books'));
    }


    //-----------------book_reservation search----------------------


    function search2(Request $request){
        // Get the search value from the request
        $search2 = $request->input('search2');

        // Search in the title and body columns from the posts table
        $books = Book::query()
            ->where('title', 'LIKE', "%{$search2}%")
            ->join('stocks', 'books.isbn', "=", 'stocks.isbn')
            ->where([
                ['title', 'LIKE', "%{$search2}%"],
                ['stocks.number', '>', 0],
            ])
            ->get();

        // Return the search view with the resluts compacted
        return view('member/book_reservation', compact('books'));
    }

}

