<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Socialite;

class googleController extends Controller
{
    public function redirectToProvider()
    {
        if(Auth::check()){
            $user = User::where('email',Auth::user()->email)->first();
            if($user != null){
                Auth::loginUsingId($user->id, TRUE);
                return redirect()->route('manager',['id' => $user->unidade]);
            }
            else
                return "Usuário não autorizado";
            //return redirect()->route('manager',['id' => Auth::user()->unidade]);
        }
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback()
    {
        $google = Socialite::driver('google')->user();

        $user = User::where('email',$google->email)->first();
        if($user != null){
            Auth::loginUsingId($user->id, TRUE);
            return redirect()->route('manager',['id' => $user->unidade]);
        }
        else
            return 'Usuário não autorizado.</br><a href="http://desconto.abel.org.br/login">Tente novamente.</a>';
            //return redirect()->route('login');

        // $user->token;
    }

    public function logoutProvider(){
        Auth::logout();
        return redirect()->route('login');
    }
}
