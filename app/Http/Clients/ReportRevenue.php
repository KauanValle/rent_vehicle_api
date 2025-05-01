<?php

namespace App\Http\Clients;

class ReportRevenue extends ExternalApiClient
{
    public function urlBase()
    {
        return env('REPORT_REVENUE_URL');
    }

    public function endpoint()
    {
        return '/reports/revenue';
    }

    public function fetchData(array $queryParams)
    {
        $response = $this->client->get($this->endpoint(), [
            'query' => $queryParams,
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
