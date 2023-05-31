<?php

namespace App\Events;

use App\Mail\PaqueteMail;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EventoEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $evento,$id;
    /**
     * Create a new event instance.
     */
    public function __construct($evento, $id)
    {
        $this->evento = $evento;
        $this->id = $id;
        Mail::to('erick@gmail.com')->send(new PaqueteMail($evento, $id));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
