<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EventDeleteJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:event-delete-job';

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
        $data = DB::table('events')
            ->join('transactions', 'transactions.id', '=', 'events.transaction_id')
            ->where([['is_deleted', '=', false], ['transactions.status_id', '=', 2]])
            ->get();
        foreach ($data as $item) {
            DB::table('events')->where('id', '=', $item->id)->update(['is_deleted'=>true]);
            DB::table('logs')->insert([
                'user_id'=>$item->clientId,
                'description'=>'Unpaid Event ' . $item->eventName . ' was DELETED by system'
            ]);
        }

    }
}
