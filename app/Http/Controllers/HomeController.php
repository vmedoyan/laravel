<?php

namespace App\Http\Controllers;
use Request;
use Auth;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('home')->with('users', $users);
    }

    public function user_save(){
        $json = [];
        $user = new User;
            $user->name = Request::input('name');
            $user->email = Request::input('email');
            $user->username = Request::input('username');
            $user->password = bcrypt(Request::input('password'));
        if($user->save()){
            $json['succes'] = 'true';
        }else{
            $json['succes'] = 'false';
        }
        return $json;
    }
}
