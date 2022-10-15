<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index(){
        $session = Auth::user();
        if($session){
            return redirect('/dashboard');
        }
        return view('login');
    }
    public function authLogin(Request $request){
        $user = Auth::attempt(['email'=>$request->email,'password'=>$request->password]);
        if($user){
            return redirect('/dashboard');
        }else{
            session()->flash('message','Data not found!!');
            return Redirect::back();
        }

    }
}
