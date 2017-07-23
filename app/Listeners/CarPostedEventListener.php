<?php

namespace App\Listeners;

use App\Events\CarPostedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarPostedEventListener
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
