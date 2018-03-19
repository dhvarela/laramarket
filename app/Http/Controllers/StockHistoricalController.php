<?php

namespace App\Http\Controllers;

use App\Helpers\HelperAlphavantage;
use App\Stock;
use App\StockHistorical;
use Barryvdh\Debugbar\LaravelDebugbar;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

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
                } else {
                    echo "error<br>";
                    \Debugbar::warning($stock_historical->errors);
                }
            }
        }
    }

    public function stockHistoricalGraph($stock_id)
    {
        $lava = new Lavacharts;

        $data = $lava->DataTable();

        $data->addDateColumn('Day of Month')
            ->addNumberColumn('Value')
            ->addNumberColumn('SMA6')
            ->addNumberColumn('SMA70')
            ->addNumberColumn('SMA200');

        $stock_values = StockHistorical::where('stock_id', $stock_id)->get();

        foreach ($stock_values as $stock_value) {
            $data->addRow([
                $stock_value->date,
                $stock_value->value,
                $stock_value->avg_6,
                $stock_value->avg_70,
                $stock_value->avg_200,
            ]);
        }

        $lava->LineChart('StockPrices', $data, [
            'titleTextStyle'    => [
                'fontName'  => 'Verdana',
                'fontColor' => 'blue',
            ],
            'title' => 'Gráfico de cortes' . Stock::getStockName($stock_id),
            'legend'=> ['position' => 'bottom']
        ]);

        echo '<div id="stocks-chart"></div>';
        echo $lava->render('LineChart', 'StockPrices','stocks-chart');

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
