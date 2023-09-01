<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ApiResponseTrait;
    //
    public function index(){
        if(Auth::user()->admin ==1){
            $users = User::get();
            return $this->apiResponse($users,'Data Returned Successfully',200);
        }else{
            return $this->apiResponse(null,'You Are Unauthorized to Access Data',401);
        }
       
    }
    public function make_admin($id){
        if(Auth::user()->admin ==1){
            $user = User::find($id);
            $user->admin = 1;
            $user->save();
            return $this->apiResponse($user,'Data Returned Successfully',200);
        }else{
            return $this->apiResponse(null,'You Are Unauthorized to Make Admin',401);
        }
    }
}
