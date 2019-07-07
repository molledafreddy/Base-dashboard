<?php

namespace App\Listeners;

use App\Events\Binnacles;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Binnacle;

class BinnaclesListener
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
     * @param  Binnacles  $event
     * @return void
     */
    public function handle(Binnacles $event)
    {
        $binnacle = new Binnacle();
        $binnacle->ip = $event->data['ip'];
        $binnacle->action = $event->data['action'];
        $binnacle->description = $event->data['description'];
        $binnacle->affected_table = $event->data['affected_table'];
        $binnacle->query = $event->data['query'];
        $binnacle->user_id = $event->data['user_id'];
        $binnacle->save();
    }
}
