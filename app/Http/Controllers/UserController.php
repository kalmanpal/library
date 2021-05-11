<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        $user-> password=$req->password;
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
        $user-> password=$req->password;
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



}
