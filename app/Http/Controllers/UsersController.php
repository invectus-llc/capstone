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
}
