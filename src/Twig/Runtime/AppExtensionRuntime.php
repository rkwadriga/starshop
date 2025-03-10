<?php

namespace App\Twig\Runtime;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Twig\Extension\RuntimeExtensionInterface;

readonly class AppExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private HttpClientInterface $client,
        private CacheInterface      $issLocationPool
    ) {
    }

    public function getIssLocationData(): array
    {
        return $this->issLocationPool->get('iss_data', function () {
            $response = $this->client->request(Request::METHOD_GET, 'https://api.wheretheiss.at/v1/satellites/25544');
            return $response->toArray();
        });
    }
}
