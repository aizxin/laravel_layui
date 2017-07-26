<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Aizxin\Repositories\\Repositories\Contracts\PermissionRepository::class, \Aizxin\Repositories\Eloquent\PermissionRepositoryEloquent::class);
        $this->app->bind(\Aizxin\Repositories\Contracts\RoleRepository::class, \Aizxin\Repositories\Eloquent\RoleRepositoryEloquent::class);
        $this->app->bind(\Aizxin\Repositories\Contracts\UserRepository::class, \Aizxin\Repositories\Eloquent\UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
