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
            'transactionId' => '',
            'clientId' => $request->clientId,
            'statusId' => $request->status
        ]);
        return response()->json(Response::HTTP_CREATED);
    }
    public function updEvent(Request $request){
        $input = DB::table('events')->where([['eventStart', '!=', $request['initialdate1']],['eventEnd', '!=', $request['initialdate2']]])->get();
        for ($i=0; $i < count($input); $i++) {
            if($request['eventStart'] < $input[$i]->eventEnd && $request['eventStart'] >= $input[$i]->eventStart){
                if($request['eventEnd'] > $input[$i]->eventStart && $request['eventEnd'] <= $input[$i]->eventEnd){
                    $response = 'Ending Date Already Booked!';
                    break;
                }
                $response = 'Starting Date Already Booked!';
                break;
            }elseif ($request['eventEnd'] > $input[$i]->eventStart && $request['eventEnd'] <= $input[$i]->eventEnd) {
                $response = 'Ending Date Already Booked!';
                break;
            }else{
                DB::table('events')
                ->where('id', $request->id)
                ->update([
                    'eventName' => $request['eventName'],
                    'eventStart' => $request['eventStart'],
                    'eventEnd' => $request['eventEnd'],
                ]);
                $response = 'Event Updated!';
            }
        }

        return response()->json($response, Response::HTTP_OK);
    }
}
