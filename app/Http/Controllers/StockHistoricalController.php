<?php

namespace App\Http\Controllers;

use App\Helpers\HelperAlphavantage;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class StockHistoricalController extends Controller
{
    public function index($stock, $method)
    {
        $params = [
            'function' => $method,
            'symbol' => $stock,
            'outputsize' => 'compact'
        ];

        dd(HelperAlphavantage::getJsonReply($params));
    }

    public function create()
    {

    }
}
