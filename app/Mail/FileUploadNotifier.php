<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FileUploadNotifier extends Mailable implements shouldQueue
{
    use Queueable, SerializesModels;

    public $result,
        $success_count,
        $error_count;

    /**
     * Create a new message instance.
     *
     * @param $result
     * @param $success_count
     * @param $error_count
     */
    public function __construct($result, $success_count, $error_count)
    {
        $this->result = $result;
        $this->success_count = $success_count;
        $this->error_count = $error_count;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.file_upload_notifier')->subject("Family Batch Upload Notification")
            ->delay(now()->addSeconds(3))->onQueue('emails');
    }

}
