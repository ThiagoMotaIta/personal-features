<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\ProtocoloVirtual;

class CreatedProtocolo
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $protocolo;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ProtocoloVirtual $protocolo)
    {
        $this->protocolo = $protocolo;
    }

    /**
     * Comment
     *
     * @return \App\Models\ProtocoloVirtual  $protocolo
     */
    public function protocolo(): ProtocoloVirtual
    {
        return $this->protocolo;
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
