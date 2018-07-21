<?php

namespace App\Jobs;

use App\BccZone;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BccZoneBulkUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $bcc_zones;
    private $file;

    /**
     * Create a new job instance.
     *
     * @param $bcc_zones
     * @param $file
     */
    public function __construct($bcc_zones, $file)
    {
        $this->file = $file;
        $this->bcc_zones = $bcc_zones;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->bcc_zones->each(function ($bcc_zone) {
            try{

                BccZone::firstOrcreate([
                    'name' => trim(ucfirst($bcc_zone->name))
                ], [
                    'name' => trim(ucfirst($bcc_zone->name)),
                    'address' => trim(ucfirst($bcc_zone->address)),
                    'streets' => empty($bcc_zone->streets) ?  null : explode(',', trim(ucfirst($bcc_zone->streets))),
                    'status' => "1"
                ]);

            } catch (\Exception $exception) {

            }
        });
    }
}
