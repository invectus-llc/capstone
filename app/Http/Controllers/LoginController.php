<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request){
        $login = Login::firstWhere('username', $request->username);
        if($login->password == $request->password){
            $id = Login::Where('username', $request->username)->pluck('id');
            // return redirect('/test')->with('data', json_encode($login));
            return redirect()->action([IndexController::class, 'dashboard'], ['user' => $id[0]]);
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
    public function test(){
        return view('test');
    }

}
