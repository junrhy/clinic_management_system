<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Model\Subscription;
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
        // Renew active subscriptions at midnight
        $schedule->call(function () {
                $subscriptions = Subscription::where('end', '<=', Carbon::now())
                                        ->where('is_active', true)
                                        ->where('auto_renew', true)
                                        ->get();

                foreach($subscriptions as $subscription) {
                    // update subscription
                    if ($subscription->frequency == 'yearly') {
                        $subscription_ends = Carbon::now()->addDays(365);
                    } else {
                        $subscription_ends = Carbon::now()->addDays(30);
                    } 

                    $subscription->start = Carbon::now();
                    $subscription->end = $subscription_ends;
                    $subscription->save();
                }

                Log::info("Subscriptions with auto-renew ENABLED has been renewed.");

        })->daily();


        // Suspend inactive subscriptions at midnight
        $schedule->call(function () {
                $subscriptions = Subscription::where('end', '<=', Carbon::now())
                                        ->where('is_active', true)
                                        ->where('auto_renew', false)
                                        ->get();

                foreach($subscriptions as $subscription) {
                    $subscription->is_active = false;
                    $subscription->save();
                }

                Log::info("Subscriptions with auto-renew DISABLED has been suspended.");
                
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
