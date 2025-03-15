<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Logs;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    public function dashboard(Request $request){
        $data = DB::table('events')
        ->join('transactions', 'transactions.id', '=', 'events.transaction_id')
        ->join('status', 'status.id', '=', 'transactions.status_id')
        ->where('is_deleted', '=', false)
        ->select('events.*', 'transactions.status_id', 'status')->get();

        $usertype = DB::table('users')->where('id', '=', $request->uid)->get('usertype_id');
        return response()->json([$data, $usertype]);
    }
    public function addEvent(Request $request){
        //dd($request);
        Transactions::Create([
            'transaction_id'=>'',
            'amount'=> 0,
            'status_id'=>2
        ]);
        $trans_id = DB::table('transactions')->latest('id')->get();

        Events::create([
            'eventName' => $request->eventName,
            'eventStart' => $request->startDate,
            'eventEnd' => $request->endDate,
            'clientId' => $request->clientId,
            'transaction_id'=>$trans_id[0]->id,
            'is_deleted'=> false
        ]);
        Logs::create([
            'user_id'=>$request->clientId,
            'description'=>'created an event: ' . $request->eventName,
        ]);
        return response()->json(Response::HTTP_CREATED);
    }
    public function updEvent(Request $request){
        //dd($request);
        try {
            $description = null;
            $input = DB::table('events')
            ->where([
                ['eventStart', '!=', $request->initialdate1],
                ['eventEnd', '!=', $request->initialdate2],
                ['is_deleted', '=', false]
            ])->get();

            $user = DB::table('events')->where('id','=', $request->id)->get();
            if($user[0]->clientId == $request->clientId){
                $description = 'updated an event: ' . $user[0]->eventName;
            } else{
                $description = $user[0]->eventName . ' event updated by admin';
            }

            if(count($input) === 0){
                DB::table('events')
                ->where('id', '=', $request->id)
                ->update([
                    'eventName' => $request->eventName,
                    'eventStart' => $request->eventStart,
                    'eventEnd' => $request->eventEnd,
                ]);
                Logs::create([
                    'user_id'=>$request->clientId,
                    'description'=>$description,
                ]);
                $response = 'Event Updated!';
            }else{
                $response = null;

                foreach ($input as $inp) {
                    if ($request['eventStart'] < $inp->eventEnd && $request['eventStart'] >= $inp->eventStart) {
                        $response = 'Starting Date or Ending Date Already Booked!';
                        break;
                    } elseif ($request['eventEnd'] > $inp->eventStart && $request['eventEnd'] <= $inp->eventEnd) {
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
                    Logs::create([
                        'user_id'=>$user[0]->clientId,
                        'description'=>$description,
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
    public function delEvent(Request $request, $id){
        $description = null;
        $user = DB::table('events')->where('id', '=', $id)->get();
        //dd($user[0]->eventName);
        if($user[0]->clientId == $request->clientId){
            $description = 'deleted an event: ' . $user[0]->eventName;
        } else{
            $description = $user[0]->eventName . ' event deleted by admin';
        }
        //dd($description);
        DB::table('events')->where('id', '=', $id)->update(['is_deleted'=> true]);
        Logs::create([
            'user_id'=>$user[0]->clientId,
            'description'=>$description
        ]);
        return response()->json(Response::HTTP_OK);
    }
}
