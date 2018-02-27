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

    public function saveStockHistoricals($stock)
    {
        $stock_values_processed = $this->_getStockClosingValues($stock);
        $sma_6_processed = $this->_getStockSMA($stock, 6);
        $sma_70_processed = $this->_getStockSMA($stock, 70);
        $sma_200_processed = $this->_getStockSMA($stock, 200);
    }

    private function _getStockClosingValues($stock)
    {
        $params = [
            'function' => config('larastock.closing_values_method'),
            'symbol' => $stock,
            'outputsize' => 'compact'
        ];

        $stock_values = HelperAlphavantage::getArrayReply($params);

        return HelperAlphavantage::processArray($stock_values);
    }

    private function _getStockSMA($stock, $sma_period)
    {
        $params = [
            'function' => config('larastock.moving_average_values_method'),
            'symbol' => $stock,
            'interval' => 'daily',
            'time_period' => $sma_period,
            'series_type' => 'close',
            'outputsize' => 'compact'
        ];

        $sma = HelperAlphavantage::getArrayReply($params);

        return HelperAlphavantage::processArray($sma);
    }
}
