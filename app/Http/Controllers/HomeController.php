<?php

namespace App\Http\Controllers;
use Request;
use Auth;
use App\User;
use App\Subgroup;
use App\Object;
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

    public function subgroups(){
        /*
        $groups = Group::whereHas('subgroup.street.object.users', function($query) use($user) {
                $query->where('id', $user->id);
            })->get(); 
        */
        $subgroups = Subgroup::all();
        

        return view('subgroups')->with('subgroups', $subgroups);
    }

    public function permission(){
        $users = User::where('is_admin',0)->get();
        $objects = Object::all();

        return view('permission')->with('users', $users)->with('objects', $objects);

    }

    public function attach(){
        $json = [];

        $user_id = Request::input('user_id');
        $object_id = Request::input('object_id');

        $userconnect = User::find($user_id);
        $userconnect->objects()->attach($object_id);


        return $json;
    }

    public function detach(){
        $json = [];

        $user_id = Request::input('user_id');
        $object_id = Request::input('object_id');

        $userconnect = User::find($user_id);
        $userconnect->objects()->detach($object_id);

        return $json;
    }
}
