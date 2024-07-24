<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    public function dashboard(){
        $data = DB::table('events')->join('status', 'status.id', '=', 'events.statusId')->select('events.*', 'status')->get();
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
    public function updEvent(Request $request){
        $input = $request->all();
        //dd($request->getContent(0));
        // for ($i=1; $i < count($input); $i++) {
        //     DB::table('events')->where('id', $request->id)->update([$request[$i] => $request[$i]]);
        // }
        DB::table('events')
        ->where('id', $request->id)
        ->update([
            'eventName' => $request['eventName'],
            'eventStart' => $request['eventStart'],
            'eventEnd' => $request['eventEnd'],
        ]);
        return response()->json(Response::HTTP_OK);
    }
}
