<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    public function register(Request $request){
        Users::create([
            'email' => $request->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'login_id' => $request->login_id,
            'usertype_id'=>2
        ]);
        return response()->json(Response::HTTP_CREATED);
    }
    public function user($id){
        $data = Users::where('users.id', '=', $id)->join('logins', 'logins.id', '=', 'users.login_id')->get();
        return response()->json($data, Response::HTTP_OK);
    }
}
