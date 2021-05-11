<?php

namespace RemoteRepository\Endpoint;

class Endpoint
{
    private const GET = 'GET';
    private const POST = 'POST';
    private const PUT = 'PUT';
    private const DELETE = 'DELETE';

    private string $method;
    private string $url;
    private string $query;
    private array $params;
    private array $body;
}
