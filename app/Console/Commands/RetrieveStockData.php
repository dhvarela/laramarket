<?php

namespace App\Console\Commands;

use App\Http\Controllers\StockHistoricalController;
use App\Stock;
use App\StockHistorical;
use Illuminate\Console\Command;

class RetrieveStockData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock_historicals:get_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Stocks Daily Data';

    protected $stock_historical;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(StockHistoricalController $stock_historical)
    {
        parent::__construct();
        $this->stock_historical = $stock_historical;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $stocks = Stock::all();

        foreach ($stocks as $stock) {

            if (!StockHistorical::StockHasAlreadyBeSavedToday($stock->id)) {

                echo "\ncronLog: " . date('d/m/Y H:i:s', time());
                echo "\nRetreiving " . $stock->acronym . "...\n";
                $this->stock_historical->saveStockHistoricals($stock->acronym);
            }
        }
    }
}
