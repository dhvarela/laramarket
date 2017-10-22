<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Market;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index($status='default')
    {
        if ($status == 'active') {
            $markets = Market::getActiveMarkets();
        } else {
            $markets = Market::getAllMarkets();
        }
        dd($markets);

    }
}
