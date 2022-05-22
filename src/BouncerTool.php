<?php

namespace Yadahan\BouncerTool;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class BouncerTool extends Tool
{
    public $roleResource = \Yadahan\BouncerTool\Nova\Ability::class;

    public $abilityResource = \Yadahan\BouncerTool\Nova\Role::class;

    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::resources([
            $this->roleResource,
            $this->abilityResource,
        ]);
    }

    /**
     * Set the resource to be used for roles.
     *
     * @return $this
     */
    public function roleResource(string $roleResource)
    {
        $this->roleResource = $roleResource;

        return $this;
    }

    /**
     * Set the resource to be used for abilities.
     *
     * @return $this
     */
    public function abilityResource(string $abilityResource)
    {
        $this->abilityResource = $abilityResource;

        return $this;
    }

    /**
     * Build the menu that renders the navigation links for the tool.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function menu(Request $request)
    {
        return MenuSection::make(__('Bouncer'), [
            MenuItem::make($this->roleResource::label())
                ->path('/resources/'.$this->roleResource::uriKey())
                ->canSee(function (NovaRequest $request) {
                    return $request->user()->can('viewAny', $this->roleResource::getModel());
                }),
            MenuItem::make($this->abilityResource::label())
                ->path('/resources/'.$this->abilityResource::uriKey())
                ->canSee(function (NovaRequest $request) {
                    return $request->user()->can('viewAny', $this->abilityResource::getModel());
                }),
        ])->icon('shield-exclamation')->collapsable();
    }
}
