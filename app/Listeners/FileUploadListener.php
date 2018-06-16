<?php

namespace App\Listeners;

use App\Events\FileUploaded;
use App\Mail\FileUploadNotifier;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FileUploadListener
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FileUploaded  $event
     * @return void
     */
    public function handle(FileUploaded $event)
    {
        $result = $event->result;

        $success_count = $error_count = 0;
        if(isset($result['success'])) {
            $success_count = count($result['success']);
        }
        if(isset($result['errors'])) {
            $error_count = count($result['errors']);
        }

        Mail::to(config('app.email'))->send(new FileUploadNotifier($event->result, $success_count, $error_count));

        Log::alert("result", $event->result);
    }
}
