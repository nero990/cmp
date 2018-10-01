<?php

namespace App\Jobs;

use App\BccZone;
use App\Events\UpdateUploadedFileStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class BccZoneBulkUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $bcc_zones;
    private $uploaded_file;

    /**
     * Create a new job instance.
     *
     * @param $bcc_zones
     * @param $uploaded_file
     */
    public function __construct($bcc_zones, $uploaded_file)
    {
        $this->uploaded_file = $uploaded_file;
        $this->bcc_zones = $bcc_zones;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $result = [];
        $this->bcc_zones->each(function ($bcc_zone) use (&$result){
            try{
                BccZone::firstOrCreate([
                    'name' => trim(ucfirst($bcc_zone->name))
                ], [
                    'name' => trim(ucfirst($bcc_zone->name)),
                    'address' => trim(ucfirst($bcc_zone->address)),
                    'streets' => empty($bcc_zone->streets) ?  null : explode(',', trim(ucfirst($bcc_zone->streets))),
                    'status' => "1",
                    'uploaded_file_id' => $this->uploaded_file->id
                ]);

                $result['success'][] = $bcc_zone->name . " created!";

            } catch (\Exception $exception) {
                $result['errors'][] = [
                    'entity' => $bcc_zone->name,
                    'error_message' => $exception->getMessage()
                ];
            }
        });

        event(new UpdateUploadedFileStatus($this->uploaded_file, $result));
    }
}
