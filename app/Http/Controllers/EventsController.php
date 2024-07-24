<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    public function dashboard($uid){
        $data = DB::table('events')->get();
        return response()->json($data);
    }
    public function addEvent(Request $request){
        Events::create([
            'eventName' => $request->eventName,
            'eventStart' => $request->startDate,
            'eventEnd' => $request->endDate,
            'clientId' => $request->clientId,
            'statusId' => $request->status
        ]);
        return response()->json(Response::HTTP_CREATED);
    }
}
