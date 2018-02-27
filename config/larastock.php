<?php

return [
    'alphavantage_key' => env('ALPHAVANTAGE_KEY',''),
    'alphavantage_base_url' => env('ALPHAVANTAGE_BASE_URL',''),
    'closing_values_method' => 'TIME_SERIES_DAILY',
    'moving_average_values_method' => 'SMA',
];