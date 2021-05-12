<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\MyTestMail;

class UserController extends Controller
{

    function show()
    {
        $data= User::all();
        return view('employee/users',['users'=>$data]);
    }

    function addData(Request $req)
    {
        $user = new User;
        $user-> email=$req->email;
        $user-> name=$req->name;
        $user-> city=$req->city;
        $user-> address=$req->address;
        $user-> password=bcrypt($req->password);
        $user-> type=$req->type;
        $user-> save();
        return redirect('/users');
    }

    function register(Request $req)
    {
        $user = new User;
        $user-> email=$req->email;
        $user-> name=$req->name;
        $user-> city=$req->city;
        $user-> address=$req->address;
        $user-> password=bcrypt('password'); $req->password;
        $user-> type=$req->type;
        $user-> save();
        return redirect('/');
    }

    function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $users = User::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        return view('employee/users', compact('users'));
    }

    function update(Request $req)
    {
        $user=User::find($req->id);
        $user-> email=$req->email;
        $user-> name=$req->name;
        $user-> city=$req->city;
        $user-> address=$req->address;
        $user-> save();
        return redirect('/home');
    }

    /*class MailSend extends Controller
    {
    public function mailsend()
        {
            $details = [
                'title' => 'Title: Mail from Real Programmer',
                'body' => 'Body: This is for testing email using smtp'
            ];

            \Mail::to('siddharthshukla089@gmail.com')->send(new SendMail($details));
            return view('emails.thanks');
        }
    }*/



}
