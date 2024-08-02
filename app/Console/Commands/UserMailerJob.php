<?php

namespace App\Console\Commands;

use App\Mail\UserMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserMailerJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user-mailer-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $contents = [];
        $mailbody = [];
        $date = now()->toDateString();
            $data = DB::table('events')
                ->where([['is_deleted','=', 0], ['eventStart', '=', $date]])
                ->join('users', 'users.id', '=','events.clientId')
                ->get(['eventName', 'eventStart', 'eventEnd', 'email', 'firstname']);
            foreach ($data as $item) {
                $contents = [
                    'name'=>$item->eventName,
                    'startDate'=>$item->eventStart,
                    'endDate'=>$item->eventEnd,
                    'firstname'=>$item->firstname,
                    'email'=>$item->email
                ];
                array_push($mailbody, $contents);
            }
        Mail::to($data[0]->email)->send(new UserMail($mailbody));
    }
}
