<?php

namespace App\Listeners;

use App\Events\UpdateUploadedFileStatus;

class UpdateUploadedFileStatusListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UpdateUploadedFileStatus  $event
     * @return void
     */
    public function handle(UpdateUploadedFileStatus $event)
    {
        $result = $event->result;
        $uploaded_file = $event->uploaded_file;

        $uploaded_file->update([
            'status' => 'COMPLETED',
            'details'=> [
                'success_count' => (isset($result['success']) ? count($result['success']) : 0),
                'error_count' => (isset($result['errors']) ? count($result['errors']) : 0),
                'errors' => (isset($result['errors']) ? $result['errors'] : null)
            ]
        ]);

    }
}
