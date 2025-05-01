<?php

namespace App\Http\Services\ElasticSearch;

use App\Enums\RentalEnum;
use Elastic\Elasticsearch\Client;
use Illuminate\Database\Eloquent\Model;

abstract class BaseElasticService
{
    protected Client $client;

    abstract protected function indexName() : string ;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function createOrUpdate(Model $data)
    {
        $this->client->index([
            'index' => $this->indexName(),
            'id' => $data['id'],
            'body' => $data->toArray(),
        ]);
    }

    public function findById(int $id): array
    {
        try {
            $data = $this->client->get([
                'index' => $this->indexName(),
                'id' => $id
            ]);

            return (array) $data->asObject()->_source;
        }catch (\Exception $e){
            throw new \Exception(RentalEnum::RENTAL_NOT_FOUND_MESSAGE, 404);
        }
    }

    public function findAll(array $query): array
    {
        $searchBody = $this->buildSearchQuery($query);

        $data = $this->client->search([
            'index' => $this->indexName(),
            'body' => $searchBody
        ]);

        $dataCollect = collect($data->asObject()->hits->hits);
        return $dataCollect->map(fn($item) => $item->_source)->toArray();
    }

    public function delete($id): void
    {
        $this->client->delete([
            'index' => $this->indexName(),
            'id' => $id,
        ]);
    }

    private function buildSearchQuery(array $query): array
    {
        if (empty($query)) {
            return [
                'query' => [
                    'match_all' => new \stdClass(),
                ],
                'size' => 10000
            ];
        }

        return [
            'query' => [
                'bool' => [
                    'must' => [
                        ['match' => $query],
                    ],
                ],
            ],
        ];
    }
}
