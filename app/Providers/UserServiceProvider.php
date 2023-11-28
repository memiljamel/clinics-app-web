<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryImpl;
use App\Services\UserService;
use App\Services\UserServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        UserService::class => UserServiceImpl::class,
        UserRepository::class => UserRepositoryImpl::class,
    ];

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides()
    {
        return [UserService::class];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
