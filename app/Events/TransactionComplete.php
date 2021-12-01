<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionComplete
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $transaction;
    public $factor;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($transaction,$factor = 1)
    {
        $this->transaction = $transaction;
        $this->factor = $factor;
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
