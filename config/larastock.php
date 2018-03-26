<?php

return [
    'alphavantage_key' => env('ALPHAVANTAGE_KEY',''),
    'alphavantage_base_url' => env('ALPHAVANTAGE_BASE_URL',''),
    'closing_values_method' => 'TIME_SERIES_DAILY',
    'moving_average_values_method' => 'SMA',
    'intersection_margin' => '0.2',
    'uptrend_message' => 'Tendencia alcista. Corte al alza',
    'uptrend_correction_message' => 'Corrección en la subida',
    'downtrend_message' => 'Tendencia bajista. Corte a la baja',
    'downtrend_correction_message' => 'Corrección en la bajada',
];