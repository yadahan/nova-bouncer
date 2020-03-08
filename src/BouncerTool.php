<?php

namespace Yadahan\BouncerTool;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Yadahan\BouncerTool\Nova\Ability;
use Yadahan\BouncerTool\Nova\Role;

class BouncerTool extends Tool
{
    public $roleResource = Role::class;

    public $abilityResource = Ability::class;

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
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('bouncer-tool::navigation');
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
}
