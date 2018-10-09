# Nova Bouncer

[![StyleCI](https://styleci.io/repos/152144400/shield?branch=master&style=flat)](https://styleci.io/repos/152144400)
[![Total Downloads](https://poser.pugx.org/yadahan/nova-bouncer/downloads?format=flat)](https://packagist.org/packages/yadahan/nova-bouncer)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat)](https://raw.githubusercontent.com/yadahan/nova-bouncer/master/LICENSE)

Use the power of [Bouncer](https://github.com/JosephSilber/bouncer) within your Nova application.

![nova bouncer screenshot](https://raw.githubusercontent.com/yadahan/nova-bouncer/master/screenshot.png)

## Installation

> Nova Bouncer requires silber/bouncer.

You may use Composer to install Nova Bouncer into your Laravel project:

    composer require yadahan/nova-bouncer dev-master

### Configuration

After installing the Nova Bouncer, publish its config using the `vendor:publish` Artisan command:

    php artisan vendor:publish --provider="Yadahan\BouncerTool\BouncerToolServiceProvider"

Next, you need to register the tool with Nova. This is typically done in the tools method of the NovaServiceProvider:

```php
// in app/Providers/NovaServiceProvder.php

// ...
public function tools()
{
    return [
        // ...
        new \Yadahan\BouncerTool\BouncerTool(),
    ];
}
```

Finally, add the Roles and Abilities `MorphToMany` fields to your User resource:

```php
// in app/Nova/User.php

// ...
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\MorphToMany;

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

## Laravel Authorization

[https://laravel.com/docs/authorization#creating-policies](https://laravel.com/docs/authorization#creating-policies)

### Generating Policies

You may generate a policy using the `make:policy` artisan command:

    php artisan make:policy UserPolicy --model=User

### Registering Policies

Once the policy exists, it needs to be registered:

```php
// in app/Providers/AuthServiceProvider.php

// ...
protected $policies = [
    // ...
    'App\User' => 'App\Policies\UserPolicy',
];
```

## Contributing

Thank you for considering contributing to the Nova Bouncer.

## License

Nova Bouncer is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
