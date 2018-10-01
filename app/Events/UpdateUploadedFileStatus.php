<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UpdateUploadedFileStatus
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $result;
    public $uploaded_file;

    /**
     * Create a new event instance.
     *
     * @param $uploaded_file
     * @param $result
     */
    public function __construct($uploaded_file, $result)
    {
        $this->result = $result;
        $this->uploaded_file = $uploaded_file;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
