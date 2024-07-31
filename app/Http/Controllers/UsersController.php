<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\Login;
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
            'contact_no' => $request->contact,
            'login_id' => $request->login_id,
            'usertype_id'=>2
        ]);
        return response()->json(Response::HTTP_CREATED);
    }
    public function user($id){
        $data = Users::where('users.id', '=', $id)->join('logins', 'logins.id', '=', 'users.login_id')->get();
        return response()->json($data, Response::HTTP_OK);
    }
    public function userUpdate(Request $request, $id){
        //dd($request);
        $input = $request;
        $logID = Users::where('id', '=', $id)->get('login_id');
        Users::where('id', '=', $id)
        ->update(['email'=>$input->email, 'firstname'=>$input->fname, 'lastname'=>$input->lname, 'contact_no'=>$input->contact]);
        Login::where('id', '=', $logID[0]->login_id)->update(['password'=>$input->pw]);
        Logs::create([
            'user_id'=>$id,
            'description'=>'updated profile'
        ]);
        return response()->json(Response::HTTP_OK);
    }
}
