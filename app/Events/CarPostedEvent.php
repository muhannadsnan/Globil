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

    public function __construct(User $user, Car $car)
    {
        $this->data = (object) ['car'=>$car, 'user'=>$user, 'message'=>"{$user->name} has created a new car {$car->brandSubdata()} {$car->modelSubdata()}", 'time'=>Carbon::now()];
        // $this->data->car = $car;
        // $this->data->user = $user;
        // $this->data->message = "{$this->user->name} has created a new car {$this->car->brandSubdata()}";
        // $this->data->time = Carbon::now();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('ch');
    }
}
