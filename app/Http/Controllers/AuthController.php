<?php

namespace App\Http\Controllers;

use App\Models\ab_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Write static login information to the session.
 * Use for test purposes.
 */
class AuthController extends Controller
{
    public function index(Request $request){
        return view('login');
    }
    public function login(Request $request) {
        Log::info('Login');
       // if($request->has('email')&& $request->has('password')){

            $email=$request->input('email');
            $password=$request->input('password');
        //}
        $user=ab_user::query()->where('ab_mail','=',$email)->orWhere('ab_name','=',$email)->first();
        if(isset($user)){
            if(Hash::check($password,$user->ab_password)){
                $request->session()->put('abalo_user', $user->ab_name);
                $request->session()->put('abalo_mail', $user->ab_mail);
                $request->session()->put('abalo_id', $user->id);
                $request->session()->put('abalo_time', time());

                return redirect()->route('haslogin');
            }else{
                $r["auth"]=false;
                $message='Deine E-Mail-Adresse oder das Passwort war nicht korrekt. Bitte versuche es noch einmal.';
                return view('login',['user'=>$r,'message'=>$message]);
            }

        }else{
            $r["auth"]=false;
            $message='Deine E-Mail-Adresse oder das Passwort war nicht korrekt. Bitte versuche es noch einmal.';
            return view('login',['user'=>$r,'message'=>$message]);
        }


    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('haslogin');
    }


    public function isLoggedIn(Request $request)
    {
        if ($request->session()->has('abalo_user')) {
            Log::info("Session is already logged in");
            $r["user"] = $request->session()->get('abalo_user');
            $r["time"] = $request->session()->get('abalo_time');
            $r["mail"] = $request->session()->get('abalo_mail');
            $r["auth"] = true;
            return redirect('/articles');
        }
        else{
            $r["auth"]=false;
            Log::info("session not ready");
            return view('login',['user'=>$r]);
        }
        //return response()->json($r);
    }

}
