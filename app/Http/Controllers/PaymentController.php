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
        $total = $item->total * 100;
        $auth = 'c2tfdGVzdF85ZW1Va0o2TjNHYXhtZ2VQRjY5WVdSaWo6';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
        'body' => '{
            "data":{
                "attributes":{
                    "send_email_receipt":false,
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
                    "success_url":"http://localhost:8000/api/success/'.$request->uid.'/'.$request->eventId.'"
                }
            }
        }',
        'headers' => [
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
            'authorization' => 'Basic '.$auth,
        ],
        ]);
        $url = json_decode($response->getBody());
        $transid = $url->data->attributes->payment_intent->id;
        DB::table('events')->where('id', '=',$request->eventId)->update(['transactionId'=> $transid]);
        return response()->json($url->data);
    }
    public function success($uid, $eventId){
        DB::table('events')->where('id', '=', $eventId)->update(['statusId' => 1]);
        return redirect('/dashboard?user=' . $uid);
        //ovverlaping edit date
    }
}
