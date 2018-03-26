<?php
/**
 * Created by PhpStorm.
 * User: dhvarela
 * Date: 19/03/18
 * Time: 18:51
 */

namespace App\Helpers;


use App\Stock;
use App\StockHistorical;
use Khill\Lavacharts\Lavacharts;

class HelperChart
{
    static public function generateStockChart($stock_id)
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
                $stock_value->price,
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

        $output = '<div id="stocks-chart"></div>';
        $output .= $lava->render('LineChart', 'StockPrices','stocks-chart');

        return $output;
    }
}