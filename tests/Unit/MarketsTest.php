<?php

namespace Tests\Unit;

use App\Market;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarketsTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testCreateMarket()
    {
        Market::create([
            'name' => 'name',
            'description' => 'description'
        ]);

        $markets = Market::getAllMarkets();
        $this->assertCount(1, $markets);
    }

    public function testCreateInactiveMarket()
    {
        Market::create([
            'name'          => 'name1',
            'description'   => 'description1',
            'active'        => 1
        ]);
        Market::create([
            'name'          => 'name2',
            'description'   => 'description2',
            'active'        => 0
        ]);

        $markets = Market::getAllMarkets();
        $this->assertCount(2, $markets);

        $markets = Market::getActiveMarkets();
        $this->assertCount(1, $markets);
    }

    public function testMarketsUsingFactories() {
        $active_markets_amount = 5;
        factory(Market::class, $active_markets_amount)->create();
        factory(Market::class)->create(['active' => 0]);

        $active_markets = Market::getActiveMarkets();
        $this->assertCount($active_markets_amount, $active_markets);

        $markets = Market::getAllMarkets();
        $this->assertCount($active_markets_amount+1, $markets);
    }
}
