<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Http\Requests\EventRequest;
use App\Models\Event;

class calendar_realtime implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $event;
    /**
     * Create a new event instance.
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('calendar'),
        ];
    }

    public function broadcastAS()
    {
        return 'events-calendar';
    }
}
