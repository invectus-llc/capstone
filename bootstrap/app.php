<?php

use App\Http\Middleware\SessionRequestMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\Middleware\StartSession;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('web',[
            StartSession::class,
        ]);
        $middleware->appendToGroup('payment',[
            StartSession::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withSchedule(function(Schedule $schedule){
        // $schedule->command('app:user-mailer-job')->dailyAt('8:00')->appendOutputTo(storage_path('logs/email.log'));
        // $schedule->command('app:event-delete-job')->twiceDaily(12, 17)->appendOutputTo(storage_path('logs/event-delete.log'));
        $schedule->command('app:user-mailer-job')->daily()->appendOutputTo(storage_path('logs/email.log'));
        $schedule->command('app:event-delete-job')->everyMinute()->appendOutputTo(storage_path('logs/event-delete.log'));
    })->create();
