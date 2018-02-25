<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class StockHistoricalController extends Controller
{
    public function index()
    {
        // https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=MSFT&interval=1min&apikey=demo
        $api_key = config('larastock.alphavantage_key');
        $stock = 'ACS.MC';
        $method = 'TIME_SERIES_DAILY';

        $url = 'https://www.alphavantage.co/query?function='.$method.'&symbol='.$stock.'&apikey='.$api_key;

        $client = new Client();
        $res = $client->request('GET',$url);
        //$res->getStatusCode();
        echo $res->getBody();
    }

    public function create()
    {

    }
}
