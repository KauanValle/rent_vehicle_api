<?php

namespace App\Observers;

use App\Jobs\Auth\DeleteAuthElasticJob;
use App\Jobs\Auth\IndexAuthElasticJob;
use App\Models\User;

class AuthObserver
{
    public function created(User $user): void
    {
        IndexAuthElasticJob::dispatch($user);
    }

    public function updated(User $user): void
    {
        IndexAuthElasticJob::dispatch($user);
    }

    public function deleted(User $user): void
    {
        DeleteAuthElasticJob::dispatch($user);
    }
}
