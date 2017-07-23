<?php

namespace App\Events;

use App\Car;
use App\User;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CarPostedEvent extends Event implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;

    public function __construct($userId, Car $car)
    {
        //$carObj = (object) [];
        $this->data = (object) [
            'car' => $car->id/*$carObj*/, 
            'userToNotify' => $userId, 
            'message' => "{$car->user->name} has created a new car {$car->brandSubdata()} {$car->modelSubdata()}", 
        ];
    }

    public function broadcastOn()
    {
        // return new PresenceChannel('ch-' . $this->data->usersToNotify);
        // return new Channel('ch');
        return new Channel('ch-' . $this->data->userToNotify);
    }
}
