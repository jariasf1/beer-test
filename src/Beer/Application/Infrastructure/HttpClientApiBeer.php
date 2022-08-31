<?php

namespace App\Beer\Application\Infrastructure;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HttpClientApiBeer
{
    public function __construct(private $beerApi)
    {
    }

    public function request(string $endpoint, string $method, array $extraOptions = []): array
    {
        $response = [];
        $client = new Client(['base_uri' => $this->beerApi, 'verify' => false]);

        $options['headers'] = ['Content-Type' => 'application/json'];
        $options['body'] = json_encode($extraOptions);

        try {
            $request = $client->request($method, $endpoint, $options);
            $response = json_decode($request->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw $e;
        }

        return $response;
    }
}