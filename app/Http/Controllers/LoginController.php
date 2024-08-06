<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request){
        $login = Login::firstWhere('username', $request->username);
        if($login !== null){
            if($login->password == $request->password){
                $id = Login::Where('username', $request->username)->pluck('id');
                // Session::push('sessionId', $id);
                // dd(Session::all());
                // return redirect('/test')->with('data', json_encode($login));
                $request->session()->put(['sessionId'=>$id[0]]);
                // return redirect()->action([IndexController::class, 'dashboard'], [$request]);
                return redirect()->route('dashboard');
            }else{
                return view('login');
            }
        }else{
            return view('login');
        }

    }
    public function register(Request $request){
        Login::create([
            'username' => $request->username,
            'password' => $request->password
        ]);
        $newlogin = Login::firstWhere('username', $request->username);
        return response()->json($newlogin, Response::HTTP_CREATED);
    }
    public function logout(){
        Session::flush();
        // dd(Session::all());
        return redirect()->route('login');
    }
    public function test(){
        return view('test');
    }

}
