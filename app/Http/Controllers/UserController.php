<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::get();
        return view('users.dashboard',compact('users'));
    }
    public function make_admin($id){
        $user = User::find($id);
        $user->admin = 1;
        $user->save();
        return redirect()->back();
    }
}
