<?php

namespace App\Model;

use Symfony\Component\HttpClient\HttpClient;

class WeatherApi
{

    /**
     * @param string $cityName
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public static function apiConnection(string $cityName): array
    {
        $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $cityName . '&appid=551236bcf81e51b1c3d780f146bc1340';
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        return $response->toArray();
    }
}