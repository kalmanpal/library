<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Session;

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
            # check user if match with database user
            $users = User::where('email', $req->email)->get();

            # check if email is more than 1
            if(sizeof($users) > 0){
                # tell user not to duplicate same email
                $msg = 'Ez az e-mail már regisztrált!';
                session(['userExistError' => $msg]);
                return back();
            }

        $user = new User;
        $user-> email=$req->email;
        $user-> name=$req->name;
        $user-> city=$req->city;
        $user-> address=$req->address;
        $pw=$req->password;
        $user-> password=bcrypt($req->password);
        $user-> type=$req->type;
        $user-> save();

        //\Mail::to('sonybalck2001@gmail.com')->send(new \App\Mail\SendMail($pw));
        \Mail::to($req->email)->send(new \App\Mail\SendMail($pw));
        //return view('emails/thanks',['pw'=>$pw]);

        return redirect("/");
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
        if(Hash::check($req->password, $user->password)){
            $user-> email=$req->email;
            $user-> name=$req->name;
            $user-> city=$req->city;
            $user-> address=$req->address;
            $user-> save();
            session(['update_message' => 'Az adatok módosítása sikerült']);
            return redirect('/data_update');
        }else{
            session(['update_message' => 'Az adatok módosítása nem sikerült']);
            return redirect('/data_update');

        }

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
