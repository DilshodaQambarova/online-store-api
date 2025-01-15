<?php

namespace App\Providers;

use App\Interfaces\Repositories\OrderRepositoryInterface;
use App\Interfaces\Repositories\PaymentCardRepositoryInterface;
use App\Interfaces\Services\OrderServiceInterface;
use App\Interfaces\Services\PaymentCardServiceInterface;
use App\Interfaces\Services\StockServiceInterface;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentCardRepository;
use App\Services\OrderService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(PaymentCardRepositoryInterface::class, PaymentCardRepository::class);
        // $this->app->bind(PaymentCardServiceInterface::class, PaymentCardService::class);
        // $this->app->bind(StockServiceInterface::class, StockService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
