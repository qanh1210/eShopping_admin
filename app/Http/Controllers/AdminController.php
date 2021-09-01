<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
class AdminController extends Controller
{
    public function getLogin(){
        // if(Auth::check()){
        //     return redirect()->to('home');
        // }
        // else{
        // }
        return view('login');


    }



    public function postLogin(Request $request){
        $email = $request['email'];
        $password = $request['password'];
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            return redirect()->to('home');
        }
        else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }
}
