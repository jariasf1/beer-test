<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class BeerSearchControllerTest extends WebTestCase
{
    const URL = '/search?q=chicken';

    private function controllerResponse($url): Response
    {
        $client = static::createClient();
        $client->request('GET', $url);
        return $client->getResponse();
    }

    public function testSearchResultIsJson() : void
    {
        $response = $this->controllerResponse(self::URL);
        $this->assertJson($response->getContent());
    }

    public function searchResultIsOkStatusCode(): void
    {
        $response = $this->controllerResponse(self::URL);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function searchResultIsCorrectJson(): void
    {
        $response = $this->controllerResponse(self::URL);
        $data = json_decode($response->getContent(), true);
        foreach ($data as $item) {
            $this->assertArrayHasKey('id', $item);
            $this->assertArrayHasKey('name', $item);
            $this->assertArrayHasKey('description', $item);
            $this->assertArrayNotHasKey('image', $item);
        }
    }

}
