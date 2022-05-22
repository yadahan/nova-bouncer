<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    |
    | The actions that are displayed in the Name field in the Ability
    | resource.
    |
    */

    'actions' => [
        '*' => __('Manage'),
        'viewAny' => __('View Any'),
        'view' => __('View'),
        'create' => __('Create'),
        'update' => __('Update'),
        'replicate' => __('Replicate'),
        'delete' => __('Delete'),
        'restore' => __('Restore'),
        'forceDelete' => __('Force Delete'),
        'runAction' => __('Run Action'),
        'runDestructiveAction' => __('Run Destructive Action'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Entities
    |--------------------------------------------------------------------------
    |
    | The entities that are displayed in the Entity Type field in the Ability
    | resource.
    |
    */

    'entities' => [
        'User' => App\Models\User::class,
        'Role' => Silber\Bouncer\Database\Role::class,
        'Ability' => Silber\Bouncer\Database\Ability::class,
    ],

];
