<?php

namespace App\Support;

use GuzzleHttp\Client as GuzzleHttpClient;

function getDataFromAPI()
{
    $client = new GuzzleHttpClient();
    $response = $client->get('https://api.tomtom.com/search/2/geocode/Via roma 104.json?key=upEwnVbILIY3XpQgAsiO3mhPUP6dQdCd');
    $data = json_decode($response->getBody(), true);

    return $data;
}
