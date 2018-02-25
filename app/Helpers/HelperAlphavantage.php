<?php

namespace App\Helpers;

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

        }

        return $return;
    }

    public static function getArrayReply ($params)
    {
        return json_decode(self::getJsonReply($params));
    }

    public static function processArray($results)
    {
        foreach ($results as $key=>$result) {
            if ($key != 'Meta Data') {
                if (is_object($result)){
                    foreach ($result as $date => $item) {
                        // TODO
                    }
                }
            }
        }
    }
}