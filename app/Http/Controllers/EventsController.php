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
        ->where('is_deleted', '=', false)
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
            'transaction_id'=>$trans_id[0]->id,
            'is_deleted'=> false
        ]);
        return response()->json(Response::HTTP_CREATED);
    }
    public function updEvent(Request $request){
        //dd($request);
        try {
            $input = DB::table('events')
            ->where([
                ['eventStart', '!=', $request->initialdate1],
                ['eventEnd', '!=', $request->initialdate2],
                ['is_deleted', '=', false]
            ])->get();
            if(count($input) === 0){
                DB::table('events')
                ->where('id', '=', $request->id)
                ->update([
                    'eventName' => $request->eventName,
                    'eventStart' => $request->eventStart,
                    'eventEnd' => $request->eventEnd,
                ]);
                $response = 'Event Updated!';
            }else{
                $response = null;

                foreach ($input as $inp) {
                    if ($request['eventStart'] < $inp->eventEnd && $request['eventStart'] >= $inp->eventStart) {
                        $response = 'Starting Date or Ending Date Already Booked!';
                        break;
                    } elseif ($request['eventEnd'] >= $inp->eventStart && $request['eventEnd'] < $inp->eventEnd) {
                        $response = 'Starting Date or Ending Date Already Booked!';
                        break;
                    }
                }
                if ($response === null) {
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
        } catch (\Throwable $th) {
            throw $th;
        }finally{
            return response()->json($response, Response::HTTP_OK);
        }
    }
    public function receipt($id){
        $data = DB::table('events')
        ->join('transactions', 'transactions.id', '=', 'events.transaction_id')
        ->join('status', 'status.id', '=', 'transactions.status_id')
        ->join('users', 'events.clientId', '=', 'users.id')
        ->where('events.id', '=', $id)
        ->get();
        return response()->json($data, Response::HTTP_OK);
    }
    public function delEvent($id){
        DB::table('events')->where('id', '=', $id)->update(['is_deleted'=> true]);
        return response()->json(Response::HTTP_OK);
    }
}
