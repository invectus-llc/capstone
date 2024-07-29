<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    public function dashboard(){
        $data = DB::table('events')
        ->join('transactions', 'transactions.id', '=', 'events.transaction_id')
        ->join('status', 'status.id', '=', 'transactions.status_id')
        ->select('events.*', 'transactions.status_id', 'status')->get();
        return response()->json($data);
    }
    public function addEvent(Request $request){
        //dd($request);
        Transactions::Create([
            'transaction_id'=>'',
            'amount'=> 0,
            'status_id'=>2
        ]);
        $trans_id = DB::table('transactions')->latest('id')->get();
        //dd($trans_id[0]->id);
        Events::create([
            'eventName' => $request->eventName,
            'eventStart' => $request->startDate,
            'eventEnd' => $request->endDate,
            'clientId' => $request->clientId,
            'transaction_id'=>$trans_id[0]->id
        ]);
        return response()->json(Response::HTTP_CREATED);
    }
    public function updEvent(Request $request){
        //dd($request);
        try {
            $input = DB::table('events')->where([['eventStart', '!=', $request->initialdate1],['eventEnd', '!=', $request->initialdate2]])->get();
            if(count($input) == 0){
                DB::table('events')
                ->where('id', '=', $request->id)
                ->update([
                    'eventName' => $request->eventName,
                    'eventStart' => $request->eventStart,
                    'eventEnd' => $request->eventEnd,
                ]);
                $response = 'Event Updated!';
            }else{
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
                        ->where('id', '=', $request->id)
                        ->update([
                            'eventName' => $request->eventName,
                            'eventStart' => $request->eventStart,
                            'eventEnd' => $request->eventEnd,
                        ]);
                        $response = 'Event Updated!';
                    }
                }
            }
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
        }

        //dd($input);


    }
}
