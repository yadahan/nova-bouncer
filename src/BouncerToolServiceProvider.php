<?php

namespace Yadahan\BouncerTool;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Models;
use Silber\Bouncer\Database\Role;
use Yadahan\BouncerTool\Policies\AbilityPolicy;
use Yadahan\BouncerTool\Policies\RolePolicy;

class BouncerToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/bouncer-tool.php', 'bouncer-tool');

        $this->app->booted(function () {
            $this->policies();
            $this->routes();
            $this->models();
        });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/bouncer-tool.php' => config_path('bouncer-tool.php'),
            ], 'bouncer-tool-config');
        }
    }

    /**
     * Register the tool's policies.
     *
     * @return void
     */
    protected function policies()
    {
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Ability::class, AbilityPolicy::class);
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }
    }

    /**
     * Register the tool's models.
     *
     * @return void
     */
    protected function models()
    {
        Nova\Ability::setModel(Models::classname(Ability::class));
        Nova\Role::setModel(Models::classname(Role::class));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
