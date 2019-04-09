<?php

namespace Yadahan\BouncerTool;

use Laravel\Nova\Nova;
use Silber\Bouncer\Database\Models;
use Silber\Bouncer\Database\Role;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Events\ServingNova;
use Silber\Bouncer\Database\Ability;
use Illuminate\Support\ServiceProvider;
use Yadahan\BouncerTool\Policies\RolePolicy;
use Yadahan\BouncerTool\Policies\AbilityPolicy;

class BouncerToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'bouncer-tool');

        $this->mergeConfigFrom(__DIR__.'/../config/bouncer-tool.php', 'bouncer-tool');

        $this->app->booted(function () {
            $this->routes();
            $this->setModels();
        });

        Nova::serving(function (ServingNova $event) {
            //
        });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/bouncer-tool.php' => config_path('bouncer-tool.php'),
            ], 'bouncer-tool-config');
        }
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
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Register the Bouncer's policies.
     *
     * @return void
     */
    protected function registerPolicies()
    {
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Ability::class, AbilityPolicy::class);
    }

    /** Set ability and role model based on Bouncer intialization */
    protected function setModels()
    {
        \Yadahan\BouncerTool\Nova\Ability::setModel(Models::classname(Ability::class));
        \Yadahan\BouncerTool\Nova\Role::setModel(Models::classname(Role::class));
    }
}
