<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;

abstract class ExternalApiClient
{
    private static $instance;
    protected Client $client;

    protected abstract function endpoint();
    protected abstract function urlBase();
    public abstract function fetchData(array $queryParams);

    public static function getInstance()
    {
        if(!isset(self::$instance)) {
            self::$instance = new static();
            self::$instance->createClient();
        }
        return self::$instance;
    }

    public function createClient()
    {
        $this->client = new Client([
            'base_uri' => $this->urlBase(),
            'timeout' => 10.0,
        ]);

        return $this;
    }
}
