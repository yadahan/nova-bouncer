# Nova Bouncer

[![StyleCI](https://styleci.io/repos/152144400/shield?branch=1.x&style=flat)](https://styleci.io/repos/152144400)
[![Total Downloads](https://poser.pugx.org/yadahan/nova-bouncer/downloads?format=flat)](https://packagist.org/packages/yadahan/nova-bouncer)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat)](https://raw.githubusercontent.com/yadahan/nova-bouncer/1.x/LICENSE)

Use the power of [Bouncer](https://github.com/JosephSilber/bouncer) within your [Nova](https://nova.laravel.com) administration panel.

![nova bouncer screenshot](https://raw.githubusercontent.com/yadahan/nova-bouncer/1.x/screenshot.png)

## Installation

> **Note**
> 
> Nova Bouncer requires silber/bouncer.

You may use Composer to install Nova Bouncer into your Laravel project:

    composer require yadahan/nova-bouncer "^1.0"

### Configuration

After installing the Nova Bouncer, you need to register the tool with Nova in `app/Providers/NovaServiceProvder.php` file:

```php
public function tools()
{
    return [
        // ...
        new \Yadahan\BouncerTool\BouncerTool,
    ];
}
```

Next, add the Roles and Abilities `MorphToMany` fields to your User resource in `app/Nova/User.php` file:

```php
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Text;

public function fields(Request $request)
{
    return [
        // ...
        MorphToMany::make('Roles', 'roles', 'Yadahan\BouncerTool\Nova\Role')->fields(function () {
            return [
                Text::make('Scope')
                    ->sortable()
                    ->rules('nullable', 'integer'),
            ];
        }),

        MorphToMany::make('Abilities', 'abilities', 'Yadahan\BouncerTool\Nova\Ability')
            ->fields(new \Yadahan\BouncerTool\Nova\PermissionsFields),
    ];
}
```

Finally, publish the Nova Bouncer config using the `vendor:publish` Artisan command:

    php artisan vendor:publish --provider="Yadahan\BouncerTool\BouncerToolServiceProvider"

After publishing the config, you may define the models and abilities that you want to manage, in `config/bouncer-tool.php` file:

```php
'entities' => [
    '*' => 'Everything',
    'App\User' => 'User',
],

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
```

### Basic Usage

A new item group (Bouncer) will appear in your Nova navigation menu.

> **Warning**
> 
> Only users who are authorized to manage the Bouncer models can see this navigation section.

You may give ability to manage the Bouncer models for a user or role:

```php
$user = User::find(1);

Bouncer::allow($user)->toManage(\Silber\Bouncer\Database\Role::class);
Bouncer::allow($user)->toManage(\Silber\Bouncer\Database\Ability::class);

// or

$role = Bouncer::role()->create(['name' => 'manage-bouncer']);

Bouncer::allow($role)->toManage(\Silber\Bouncer\Database\Role::class);
Bouncer::allow($role)->toManage(\Silber\Bouncer\Database\Ability::class);

$user->assign($role);
```

## Laravel Authorization

[https://laravel.com/docs/authorization#creating-policies](https://laravel.com/docs/authorization#creating-policies)

### Generating Policies

You may generate a policy using the `make:policy` artisan command:

    php artisan make:policy UserPolicy --model=User

## Contributing

Thank you for considering contributing to the Nova Bouncer.

## License

Nova Bouncer is open-sourced software licensed under the [MIT license](LICENSE).
