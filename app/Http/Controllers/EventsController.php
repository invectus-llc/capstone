<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventsController extends Controller
{
    public function dashboard(){
        return response()->json(Events::all());
    }
    public function addEvent(Request $request){
        Events::create([
            'eventName' => $request->eventName,
            'eventStart' => $request->startDate,
            'eventEnd' => $request->endDate,
            'clientId' => $request->clientId,
            'status' => $request->status
        ]);
        return response()->json(Response::HTTP_CREATED);
    }
}
