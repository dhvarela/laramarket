<?php

namespace App\Listeners;

use App\Events\Intersections;
use App\Helpers\HelperIntersection;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IntersectionsListener
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
     * @param  Intersections  $event
     * @return void
     */
    public function handle(Intersections $event)
    {
        //
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Intersection',
            'App\Listeners\IntersectionsListener@onNewHistoricalValue'
        );
    }

    public function onNewHistoricalValue($stock_values)
    {
        list($icon, $message) = HelperIntersection::checkIntersection($stock_values);

        if (!empty ($message)) {
            // check user stocks

            // notify
        }

    }
}
