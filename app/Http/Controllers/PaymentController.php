<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function pay(Request $request){
        $transid = '';
        $item = $request;
        $total = $item->total;
        $auth = 'c2tfdGVzdF85ZW1Va0o2TjNHYXhtZ2VQRjY5WVdSaWo6';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
        'body' => '{
            "data":{
                "attributes":{
                    "send_email_receipt": true,
                    "show_description":true,
                    "show_line_items":true,
                    "description":"Function Hall Rental For: '.$item->eventName. ', From: '.$item->eventStart.', To: '.$item->eventEnd.'",
                    "line_items":[{
                        "currency":"PHP",
                        "amount":8000000,
                        "description":"Rental Fee",
                        "name":"Days",
                        "quantity":'.$item->eventDays.'
                    }],
                    "payment_method_types":[
                        "qrph",
                        "card",
                        "dob",
                        "paymaya",
                        "billease",
                        "gcash",
                        "grab_pay"
                    ],
                    "success_url":"http://localhost:8000/api/success/'.$request->uid.'/'.$request->transId.'"
                }
            }
        }',
        'headers' => [
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
            'authorization' => 'Basic '.$auth,
            'Access-Control-Allow-Origin', '*',
            'Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers', 'Content-Type, Authorization'
        ],
        ]);
        $url = json_decode($response->getBody());
        $transid = $url->data->attributes->payment_intent->id;
        //$trans_id = DB::table('events')->where('id','=',$request->eventId)->get('transaction_id');
        //dd($trans_id);
        Session::put(['payment_id'=>$url->data->id]);
        DB::table('transactions')->where('id', '=',$request->transId)->update(['transaction_id'=> $transid, 'amount'=>$total]);
        return response()->json($url->data);
        // return redirect($url->data->attributes->checkout_url);
    }
    public function success($uid, $transId, Request $request){
        // $sessionid = Session::get('payment_id');
        // dd($sessionid);
        $event = DB::table('events')->where('transaction_id', '=', $transId)->get();
        DB::table('transactions')->where('id', '=', $transId)->update(['status_id' => 1, 'updated_at'=>now()]);
        DB::table('logs')->insert([
            'user_id'=>$uid,
            'description'=>'successfully paid event: ' . $event[0]->eventName,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        $request->session()->put(['sessionId'=>$uid]);
        return redirect()->route('dashboard');
        //ovverlaping edit date
    }
}
