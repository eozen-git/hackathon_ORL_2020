<?php

namespace App\Model;

use Symfony\Component\HttpClient\HttpClient;

class MuseumApi
{

    /**
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public static function apiConnection(int $objectId): array
    {
        $url = 'https://collectionapi.metmuseum.org/public/collection/v1/objects/'. $objectId;
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        return $response->toArray();
    }
}
