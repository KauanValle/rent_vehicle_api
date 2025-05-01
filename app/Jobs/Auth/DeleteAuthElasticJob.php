<?php

namespace App\Jobs\Auth;

use App\Http\Services\ElasticSearch\AuthElasticService;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteAuthElasticJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function handle(AuthElasticService $authElasticService): void
    {
        $authElasticService->delete($this->model->id);
    }
}
