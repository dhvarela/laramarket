<?php

namespace App\Http\Controllers;

use App\Stock;
use App\UserStocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $user_stocks = [];
        if (Auth::check()) {
            $user_stocks = array_keys(UserStocks::getUserStocks(Auth::id()));
        }

        return view('stocks.index', ['stocks' => $stocks, 'user_stocks' => $user_stocks]);
    }
}
