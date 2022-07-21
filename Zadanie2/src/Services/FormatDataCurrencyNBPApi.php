<?php

namespace App\Services;

class FormatDataCurrencyNBPApi
{
    public function decodeJson($test) {
        $testArray = json_decode($test);
        $container=[];
        foreach ($testArray as $item) {

            foreach ($item->rates as $value) {
                $container[]=$value;
            }
        }
        return $container;
    }
}