<?php

namespace App\Http\Controllers\manager;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
       return view('manager.usuario');
   }
   public function create(Request $request,$id){
       $user = new User();
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = $request->email;
       $user->unidade = $request->unidade;
       $user->profile = $request->profile;
       $user->token = $request->token;
       //dd($user);
       $user->save();
       return redirect()->back();
   }
}
