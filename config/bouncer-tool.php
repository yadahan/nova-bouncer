<?php

return [

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
        '*' => 'Everything',
        'App\User' => 'User',
        'Silber\Bouncer\Database\Role' => 'Role',
        'Silber\Bouncer\Database\Ability' => 'Ability',
    ],

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
        '*' => 'All abilities',
        'viewAny' => 'View any',
        'view' => 'View',
        'create' => 'Create',
        'update' => 'Update',
        'delete' => 'Delete',
        'restore' => 'Restore',
        'forceDelete' => 'Force delete',
    ],

];
