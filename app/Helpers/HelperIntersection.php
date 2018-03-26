<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 26/03/18
 * Time: 21:18
 */

namespace App\Helpers;


class HelperIntersection
{
    static public function checkIntersection ($stock_values)
    {
        $icon = $message = '';
        $margin = config('larastock.intersection_margin');
        $avg_6_crosses_avg_70 = abs($stock_values->avg_70 - $stock_values->avg_6) <= $margin;
        $avg_6_bigger_avg_70 = $stock_values->avg_6 >= $stock_values->avg_70;
        $avg_70_bigger_avg_200 = $stock_values->avg_70 >= $stock_values->avg_200;

        if ($avg_6_crosses_avg_70) {
            if ($avg_6_bigger_avg_70) {
                if ($avg_70_bigger_avg_200) {
                    $icon = 'glyphicon-triangle-top';
                    $message = config('larastock.uptrend_message');
                } else {
                    $icon = 'glyphicon-menu-down';
                    $message = config('larastock.downtrend_correction_message');
                }
            } else {
                if ($avg_70_bigger_avg_200) {
                    $icon = 'glyphicon-menu-up';
                    $message = config('larastock.uptrend_correction_message');
                } else {
                    $icon = 'glyphicon-triangle-bottom';
                    $message = config('larastock.downtrend_message');
                }
            }
        }


        return [$icon, $message];
    }

    static function getIntersections ($stock_historicals)
    {
        foreach ($stock_historicals as $key=>$stock_values) {
            $stock_historical[$key]['intersection'] = '';
            list($icon, $message) = self::checkIntersection($stock_values);
            if (!empty($icon)) {
                $stock_historical[$key]['intersection'] =
                    '<span class="glyphicon ' .$icon . '" title="' .$message .'"></span>';
            }
        }
    }
}