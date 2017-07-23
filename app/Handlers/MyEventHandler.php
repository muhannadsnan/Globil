<?php

namespace App\Handlers;

use App\Events\CarPostedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyEventHandler
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CarPostedEvent  $event
     * @return void
     */
    public function handle(CarPostedEvent $event)
    {
        //
    }
}
