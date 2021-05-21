<?php

namespace App\Listeners;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\ModelCreated as EventModelCreated;
use App\Notifications\ModelCreated as ModelCreatedNotification;
class ModelCreated
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
     * @param  ModelCreated  $event
     * @return void
     */
    public function handle(EventModelCreated $event)
    {
        $event->model->notify(new ModelCreatedNotification);
    }
}
