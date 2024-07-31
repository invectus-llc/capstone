<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogsController extends Controller
{
    public function userlogs($id){
        $data = Logs::where('user_id', '=', $id)->orderBy('id', 'desc')->get();
        return response()->json($data, Response::HTTP_OK);
    }
}
