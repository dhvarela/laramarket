<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    //return view('welcome');
    return redirect('markets');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/markets/create', 'MarketController@create')->name('market-create');
Route::post('/markets/create', 'MarketController@store')->name('markets.create');

Route::get('/markets/{id}', 'MarketController@show')->name('markets.show');

Route::get('/markets/{id}/edit', 'MarketController@edit');
Route::put('/markets/{id}/edit', 'MarketController@update')->name('markets.edit');

Route::delete('/markets/{id}', 'MarketController@destroy')->name('markets.destroy');

Route::get('/markets/{status?}', 'MarketController@index');

Route::get('/stocks', 'StockController@getAllStocks');

Route::get('/stocks-from-market/{market_id}', 'StockController@getStocksFromMarket')->name('stocks_by_market');

//Route::resource('stock_historicals', 'StockHistoricalController',['only' => ['index','create']]);
Route::get('/stock_historicals/{stock}/{method}', 'StockHistoricalController@index');
Route::get('/save_stock_historicals/{stock}', 'StockHistoricalController@saveStockHistoricals');
Route::get('/save_stock_historicals_charts/{stock_id}', 'StockHistoricalController@stockHistoricalGraph');
