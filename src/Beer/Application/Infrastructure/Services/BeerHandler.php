<?php

namespace App\Beer\Application\Infrastructure\Services;

use App\Beer\Application\Infrastructure\HttpClientApiBeer;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class BeerHandler extends Handler
{
    public function __construct(LoggerInterface $logger, private NormalizeBeerObject $normalizeBeerObject, private HttpClientApiBeer $apiBeer)
    {
        parent::__construct($logger);
    }

    public function search(Request $request, array $parameters): array
    {
        $query = http_build_query(['food' => $request->get('q')]);
        $result = $this->apiBeer->request('/v2/beers?'.$query, Request::METHOD_GET, []);

        return $this->dataNormalizer($result, $parameters['serializeContext']);
    }

    public function detail(Request $request, array $parameters): array
    {
        $result = $this->apiBeer->request('/v2/beers/'.$parameters['id'], Request::METHOD_GET, []);
        return $this->dataNormalizer($result, $parameters['serializeContext']);
    }

    private function dataNormalizer(array $result, array $context): array
    {
        $content = [];
        $normalize = $this->normalizeBeerObject->normalize($result);
        foreach ($normalize as $item) {
            $content[] = $this->normalizeBeerObject->serializer($item, $context);
        }
        return $content;
    }
}