<?php

namespace App\Jobs\Rental;

use App\Http\Services\ElasticSearch\RentalElasticService;
use App\Models\Rental;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteRentalElasticJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Rental $rental;

    /**
     * Create a new job instance.
     */
    public function __construct(Rental $rental)
    {
        $this->rental = $rental;
    }

    /**
     * Execute the job.
     */
    public function handle(RentalElasticService $rentalElasticService): void
    {
        $rentalElasticService->delete($this->rental->id);
    }
}
