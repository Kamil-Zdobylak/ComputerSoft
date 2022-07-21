<?php

namespace App\Services;

use GuzzleHttp;

class GetCurrenciesFromNBPApi
{
    public function makeRequest()
    {
        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', 'http://api.nbp.pl/api/exchangerates/tables/A?format=json');


        return $res->getBody()->getContents();

    }


}