<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewFormRequestEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $formRequest;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($formRequest)
    {
        $this->formRequest = $formRequest;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
    }
}
