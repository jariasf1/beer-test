<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ControllerTestCase extends WebTestCase
{
    protected function controllerResponse($url): Response
    {
        $client = static::createClient();
        $client->request('GET', $url);
        return $client->getResponse();
    }
}