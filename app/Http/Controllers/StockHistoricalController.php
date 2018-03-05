<?php

namespace App\Http\Controllers;

use App\Helpers\HelperAlphavantage;
use App\Stock;
use App\StockHistorical;
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
        $stock_id = Stock::getStockId($stock);

        $stock_values_processed = $this->_getStockClosingValues($stock);
        $sma_6_processed = $this->_getStockSMA($stock, 6);
        $sma_70_processed = $this->_getStockSMA($stock, 70);
        $sma_200_processed = $this->_getStockSMA($stock, 200);

        if (is_array($stock_values_processed)) {
            $stock_historical = new StockHistorical();

            foreach ($stock_values_processed as $date => $stock_value) {
                $input = [
                    'stock_id' => $stock_id,
                    'date' => $date,
                    'price' => $stock_value,
                    'avg_6' => $sma_6_processed[$date],
                    'avg_70' => $sma_70_processed[$date],
                    'avg_200' => $sma_200_processed[$date],
                ];

                if ($stock_historical->validate($input)) {
                    $stock_historical_save = StockHistorical::create($input);

                    echo "\n Saved values of $stock from date: $date \n";
                }
            }
        }
    }

    private function _getStockClosingValues($stock)
    {
        $params = [
            'function' => config('larastock.closing_values_method'),
            'symbol' => $stock,
            'outputsize' => 'compact'
        ];

        $stock_values = HelperAlphavantage::getArrayReply($params);

        return HelperAlphavantage::processArray($stock_values, true);
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
