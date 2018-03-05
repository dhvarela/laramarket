<?php

namespace App\Helpers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class HelperAlphavantage
{

    private static function config()
    {

        return [
            'api_key'   => config('larastock.alphavantage_key'),
            'base_url'   => config('larastock.alphavantage_base_url'),
        ];
    }

    public static function getJsonReply($params)
    {
        $return = null;

        $config = self::config();

        $url = $config['base_url'] .'?'.
            http_build_query($params) .
            '&apikey=' . $config['api_key'];

        try {

            $client = new Client();
            $res = $client->request('GET', $url);

            if ($res->getStatusCode() == 200) {
                return $res->getBody()->getContents();
            } else {
                $return = $res->getStatusCode();
            }

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }
        }

        return $return;
    }

    public static function getArrayReply ($params)
    {
        $res = self::getJsonReply($params);

        return json_decode($res);
    }

    public static function processArray($results, $multiple_values = false)
    {
        $formatted_array = [];

        foreach ($results as $key=>$result) {
            if ($key != 'Meta Data') {
                if (is_object($result)){
                    foreach ($result as $date => $item) {
                        if (!self::isStockHistoricalFromToday($date)) {
                            if(preg_match('/\d{4}-\d{2}-\d{2}$/',$date)) {
                                if ($multiple_values) {
                                    $string = '4. close';
                                    $formatted_array[$date] = $item->{$string};
                                } else {
                                    $formatted_array[$date] = end($item);
                                }
                            }
                        }
                    }
                }
            }
        }

        return $formatted_array;
    }

    public static function isStockHistoricalFromToday($stock_date)
    {
        return $stock_date == Carbon::today()->toDateString();
    }

}