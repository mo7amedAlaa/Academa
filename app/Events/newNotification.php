<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class newNotification implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $message;
    public $timestamp;

    /**
     * Create a new event instance.
     *
     * @param string $message The content of the notification.
     */
    public function __construct($message)
    {
        $this->message = $message; // The content of the message
        $this->timestamp = Carbon::now()->toDateTimeString(); // Timestamp for when the notification was created
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('new-notification'), // Broadcast on the 'new-notification' channel
        ];
    }

    /**
     * The data that should be broadcast with the event.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'timestamp' => $this->timestamp, // You can include the timestamp in the broadcast
        ];
    }
}
