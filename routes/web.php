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
Route::get('/save_stock_historicals_charts/{stock_id}', 'StockHistoricalController@stockHistoricalGraph')->name('get_stock_historicals_info');
Route::get('/stock_historical/{stock_id}', 'StockHistoricalController@getStockHistoricalInfo')->name('stock_historicals_chart');

Route::get('/stock_historical/{stock_id}/intersect', function() {
    $stock = App\StockHistorical::find(276);
    event('App\Events\Intersection', $stock);
});

Route::post('user_stocks', 'UserStocksController@store')->name('user_stocks.create');
Route::delete('user_stocks', 'UserStocksController@destroy')->name('user_stocks.destroy');

Route::get('send_test_email', function () {
    Mail::raw('Send test mail', function ($message){
        $message->to('danilarastock@mailinator.com');
    });
});
