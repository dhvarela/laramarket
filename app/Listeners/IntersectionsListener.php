<?php

namespace App\Listeners;

use App\Events\Intersections;
use App\Helpers\HelperIntersection;
use App\Notifications\StockIntersection;
use App\User;
use App\UserStocks;
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

            $stock_followers = UserStocks::getStockFollowers($stock_values->stock_id);

            foreach ($stock_followers as $follower_id) {
                $user = User::find($follower_id);
                $user->notify(new StockIntersection($stock_values, $message));

            }
        }

    }
}
