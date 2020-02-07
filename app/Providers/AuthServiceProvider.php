<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Hive' => 'App\Policies\HivePolicy',
        'App\HiveType' => 'App\Policies\HiveTypePolicy',
        'App\Apiary' => 'App\Policies\ApiaryPolicy',
        'App\Queen' => 'App\Policies\QueenPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
