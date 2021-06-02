<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $resToDelete = DB::table('reservations')
            ->where('expiry',"<",Carbon::today())
            ->get();

            $isbn = $resToDelete->isbn;
            $email = $resToDelete->email;
            $resToDelete->delete();

            $stock = DB::table('stocks')
            ->where('stocks.isbn', "=", $isbn)
            ->get();

            $number = $stock->number;

            $stockToSave = DB::table('stocks')
            ->where('stocks.isbn', $isbn)
            ->update(['number' => $number + 1]);

            $user = DB::table('users')
            ->where('users.email', "=", $email)
            ->get();

            $current = $user->current;

            $userToSave = DB::table('users')
            ->where('users.email', $email)
            ->update(['current' => $current - 1]);

        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
