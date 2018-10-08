<?php

declare(strict_types=1);

namespace Yadahan\BouncerTool\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any roles.
     *
     * @return mixed
     */
    public function viewAny()
    {
        //
    }

    /**
     * Determine whether the user can view the role.
     *
     * @return mixed
     */
    public function view()
    {
        //
    }

    /**
     * Determine whether the user can create roles.
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Determine whether the user can update the role.
     *
     * @return mixed
     */
    public function update()
    {
        //
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @return mixed
     */
    public function delete()
    {
        //
    }

    /**
     * Determine whether the user can restore the role.
     *
     * @return mixed
     */
    public function restore()
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the role.
     *
     * @return mixed
     */
    public function forceDelete()
    {
        //
    }
}
