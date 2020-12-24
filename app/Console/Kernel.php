<?php

namespace App\Console;

use App\Mail\ProductExpiredMail;
use App\Mail\ProductPendingMail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\UpdatePermissions::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $products = Product::where('end_at', '<=', now())->where('status', 1)->get();

            foreach ($products as $product) {

                if ($product->highest_value < $product->min_price) {
                    $product->update(['status' => 5]);
                    $biders = $product->biders()->get();
                    foreach ($biders as $bider) {
                        $bider->increment('balance', $product->deposit);
                        $bider->transactions()->create([
                            'user_id' => $bider->id,
                            'value'     => $product->deposit,
                            'action'    => 3,
                        ]);
                    }

                    Mail::to($product->owner->email)->send(new ProductExpiredMail($product));
                } else {
                    $product->update(['status' => 2]);
                    $biders = $product->biders()->where('user_id', '!=', $product->winner_id)->get();
                    foreach ($biders as $bider) {
                        $bider->increment('balance', $product->deposit);
                        $bider->transactions()->create([
                            'user_id' => $bider->id,
                            'value'     => $product->deposit,
                            'action'    => 3,
                        ]);
                    }
                    Mail::to($product->owner->email)->send(new ProductPendingMail($product));
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
