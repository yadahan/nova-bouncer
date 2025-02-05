<?php

namespace Yadahan\BouncerTool\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphedByMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Silber\Bouncer\Database\Models as BouncerModels;
use Silber\Bouncer\Database\Titles\RoleTitle;

class Role extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Silber\Bouncer\Database\Role::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'title',
    ];

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * Set the model to be used for roles.
     *
     * @param  string  $model
     * @return void
     */
    public static function setModel($model)
    {
        static::$model = $model;
    }

    /**
     * Get the model to be used for roles.
     *
     * @return void
     */
    public static function getModel()
    {
        return static::$model;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()
                ->sortable()
                ->showOnPreview(),

            Text::make('Name')
                ->rules('required', 'max:255')
                ->sortable()
                ->showOnPreview(),

            Text::make('Title')
                ->dependsOn([
                    'name',
                ], function (Text $field, NovaRequest $request, FormData $formData) {
                    $field->default(RoleTitle::from(new static::$model([
                        'name' => $formData->name,
                    ]))->toString());
                })
                ->rules('max:255')
                ->sortable()
                ->showOnPreview(),

            Number::make('Scope')
                ->nullable()
                ->sortable()
                ->showOnPreview(),

            MorphedByMany::make('Abilities')
                ->fields(new PermissionsFields),

            ...(\Nova::resourceForModel(BouncerModels::classname('App\User')) ? [HasMany::make('Users')] : []),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the URI key for the resource.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'bouncer-roles';
    }
}
