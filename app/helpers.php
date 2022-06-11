<?php

function countryByCode($code)
{
    $client = new GuzzleHttp\Client();

    $res = $client->request('GET', 'http://api.countrylayer.com/v2/callingcode/'.$code.'?access_key=700ac46828d90b7e9e7d7265e333c689', [
      
    ]);

    $res->getStatusCode(); 

    return json_decode($res->getBody()->getContents(), true);
}
?>