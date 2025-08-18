<?php

namespace App\Jobs;

use App\Models\Location;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckLocationStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The location instance.
     *
     * @var \App\Models\Location
     */
    protected $location;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\Location $location
     * @return void
     */
    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        // Jangan proses jika tidak ada IP address
        if (empty($this->location->ip_address)) {
            return;
        }

        // Menentukan perintah ping berdasarkan sistem operasi
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Perintah untuk Windows
            $command = "ping -n 1 " . escapeshellarg($this->location->ip_address);
        } else {
            // Perintah untuk Linux/macOS
            $command = "ping -c 1 " . escapeshellarg($this->location->ip_address);
        }

        // Jalankan perintah ping
        exec($command, $output, $result);

        // Perbarui status berdasarkan hasil ping
        // $result === 0 berarti ping berhasil (ONLINE)
        $this->location->status = ($result === 0) ? 'ONLINE' : 'OFFLINE';
        $this->location->save();
    }
}
