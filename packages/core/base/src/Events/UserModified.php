<?php

namespace Messi\Base\Events;

use Illuminate\Broadcasting\Channel;
use Messi\Base\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserModified
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var User */
    public $user;

    public $roleId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $roleId)
    {
        $this->user = $user;
        $this->roleId = $roleId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
