<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function getAllStocks()
    {
        $stocks = Stock::getAllStocksAndMarkets();
        dd($stocks->toArray());
    }

    public function getStocksFromMarket($market_id)
    {
        $stocks = Stock::getAllStocksFromMarket($market_id);
        return view('stocks.index', ['stocks' => $stocks]);
    }
}
