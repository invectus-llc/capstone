<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request){
        $login = Login::firstWhere('username', $request->username);
        $id = Login::Where('username', $request->username)->pluck('id');
        session(['id' => 2]);
        return response()->json($login);
        //move to index controller so session would work
    }
    public function register(Request $request){
        Login::create([
            'username' => $request->username,
            'password' => $request->password
        ]);
        $newlogin = Login::firstWhere('username', $request->username);
        return response()->json($newlogin);
    }
}
