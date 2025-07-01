<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewUserRegisterEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function __construct(public User $user)
    {
        $this->user = $user;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('new_user_channel'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'new_user_registered_event'; // name of the event (optional) insted of using the class name to listen to the event
    }

    // public function broadcastWith(): array
    // {
    //     return ['user_id' => $this->user->id]; // specify the data you want to broadcast
    // }

    // public function broadcastWhen(): bool
    // {
    //     return $this->user->age > 25; // condition to broadcast the event, for example
    // }
}
