<?php

namespace App\Beer\Application\Infrastructure;

use Symfony\Component\HttpFoundation\JsonResponse;

class JsonApiResponse extends JsonResponse
{
    protected function __construct(
        protected int $code,
        protected array $body
    ) {
        parent::__construct(data: $body, status: $code, headers: []);
    }

    public static function create(array|null $data = null, string|null $message = null, int $code = 200): JsonApiResponse
    {
        assert($code >= 200 && $code < 300);

        return new self(
            code: $code,
            body: [
                'data'    => $data,
                'errors'  => null,
                'message' => $message,
            ],
        );
    }
}