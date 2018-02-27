<?php

namespace App\Http\Controllers;

use App\Helpers\HelperAlphavantage;
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

        $stock_values = HelperAlphavantage::getArrayReply($params);

        $processedArray = HelperAlphavantage::processArray($stock_values);

        var_dump($processedArray);
    }

    public function create()
    {

    }
}
