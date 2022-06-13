<?php

function countryByCode($code)
{
    // Log::info("geting country by given code");
    $client = new GuzzleHttp\Client();

    $res = $client->request('GET', 'http://api.countrylayer.com/v2/callingcode/'.$code.'?access_key=700ac46828d90b7e9e7d7265e333c689', [
      
    ]);

    $res->getStatusCode(); 
    // Log::info(json_decode($res->getBody()->getContents(), true));
    // Log::info("country");
    return json_decode($res->getBody()->getContents(), true);
}
?>