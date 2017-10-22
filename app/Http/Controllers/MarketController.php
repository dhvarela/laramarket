<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Market;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index()
    {
        $markets = Market::getAllMarkets();
        dd($markets);


    }
}
