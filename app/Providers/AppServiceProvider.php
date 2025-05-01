<?php

namespace App\Providers;

use App\Http\Services\CustomerService;
use App\Models\Customer;
use App\Models\Rental;
use App\Models\User;
use App\Models\Vehicle;
use App\Observers\AuthObserver;
use App\Observers\CustomerObserver;
use App\Observers\RentalObserver;
use App\Observers\VehicleObserver;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, function () {
            return ClientBuilder::create()
                ->setHosts([env('ELASTICSEARCH_HOST', 'localhost:9200')])
                ->setElasticMetaHeader(false)
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Customer::observe(CustomerObserver::class);
        Vehicle::observe(VehicleObserver::class);
        Rental::observe(RentalObserver::class);
        User::observe(AuthObserver::class);
    }
}
