<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function select($id){
        try {
            return response()->json(Login::findOrFail($id));
        } catch (\Throwable $th) {
            throw $th;
        }
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
