<?php

use Illuminate\Database\Seeder;
use App\Market;

class IbexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $market = Market::create([
            'name'  => 'IBEX35',
            'description' => 'Mercado continuo español'
        ]);

        $market_id = $market->getKey();

        $stocks = [
            'ABE'   => 'Abertis',
            'ANA'   => 'Acciona',
            'ACX'   => 'Acerinox',
            'ACS'   => 'ACS',
            'AENA'  => 'Aena',
            'AMS'   => 'Amadeus',
            'MTS'   => 'Arcelormittal',
            'BBVA'  => 'BBVA',
            'BKIA'  => 'Bankia',
            'BKT'   => 'Bankinter',
            'CABK'  => 'Caixabank',
            'CLNX'  => 'Cellnex Telecom',
            'DIA'   => 'Día',
            'ENG'   => 'Enagas',
            'ELE'   => 'Endesa',
            'FER'   => 'Ferrovial',
            'GAM'   => 'Gamesa',
            'GAS'   => 'Gas Natural',
            'GRF'   => 'Grifols',
            'IAG'   => 'IAG Group',
            'IBE'   => 'Iberdrola',
            'ITX'   => 'Inditex',
            'IDR'   => 'Indra Sistemas',
            'COL'   => 'Inmobiliaria Colonial',
            'MAP'   => 'Mapfre',
            'TL5'   => 'Mediaset España',
            'MEL'   => 'Melià Hotels',
            'MRL'   => 'Merlín',
            'REE'   => 'Red Eléctrica',
            'REP'   => 'Repsol',
            'SAB'   => 'Sabadell',
            'SAN'   => 'Santander',
            'TRE'   => 'Técnicas Reunidas',
            'TEF'   => 'Telefónica',
            'VIS'   => 'Viscofan',
        ];

        foreach ($stocks as $acronym => $stock_name) {
            \App\Stock::create(
                [
                    'name'  => $stock_name,
                    'acronym'  => $acronym,
                    'market_id'  => $market_id,

                ]
            );
        }
    }
}
