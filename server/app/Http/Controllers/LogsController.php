<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class LogsController extends Controller
{
    public function userlogs($id){
        $data = Logs::join('users', 'users.id', '=', 'logs.user_id')->orderBy('logs.id', 'desc')->get();
        $usertype = DB::table('users')->where('id', '=', $id)->get('usertype_id');
        return response()->json([$data, $usertype], Response::HTTP_OK);
    }
}
