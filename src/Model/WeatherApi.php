<?php

namespace App\Model;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class WeatherApi
{

    /**
     * @param int $cityId
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public static function apiConnection(int $cityId): array
    {
        $url = 'https://api.openweathermap.org/data/2.5/weather?id='
            . $cityId . '&appid=551236bcf81e51b1c3d780f146bc1340';
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        return $response->toArray();
    }
}
