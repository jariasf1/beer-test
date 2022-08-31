<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class BeerDetailControllerTest extends ControllerTestCase
{

    const URL = '/detail/1';

    public function testDetailResultIsJson(): void
    {
        $response = $this->controllerResponse(self::URL);
        $this->assertJson($response->getContent());
    }

    public function testDetailResultIsOkStatusCode(): void
    {
        $response = $this->controllerResponse(self::URL);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testDetailResultIsCorrectJson(): void
    {
        $response = $this->controllerResponse(self::URL);
        $data = json_decode($response->getContent(), true);
        foreach ($data as $item) {
            $this->assertArrayHasKey('id', $item);
            $this->assertArrayHasKey('name', $item);
            $this->assertArrayHasKey('description', $item);
            $this->assertArrayHasKey('image', $item);
        }
    }
}
