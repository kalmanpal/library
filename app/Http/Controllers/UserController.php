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
        return redirect('/login');
    }




}
