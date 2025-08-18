<?php

namespace App\Console\Commands;

use App\Jobs\CheckLocationStatus;
use App\Models\Location;
use Illuminate\Console\Command;

class CheckWinfreeStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'winfree:check-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch jobs to check the status of all WinFree locations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching locations and dispatching status check jobs...');

        // Ambil semua lokasi yang memiliki ip_address
        $locations = Location::whereNotNull('ip_address')->where('ip_address', '!=', '')->get();

        if ($locations->isEmpty()) {
            $this->info('No locations with an IP address to check.');
            return 0;
        }

        foreach ($locations as $location) {
            CheckLocationStatus::dispatch($location);
        }

        $this->info('Successfully dispatched ' . $locations->count() . ' jobs.');
        return 0;
    }
}
