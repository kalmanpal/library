<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    function addData(Request $req)
    {

        $user = new User();
        $user-> email=$req->email;
        $user-> name=$req->name;
        $user-> city=$req->city;
        $user-> address=$req->address;
        $user-> type=$req->type;
        $user-> password=$req->password;
        $user-> save();
        return redirect('/');
    }
}
