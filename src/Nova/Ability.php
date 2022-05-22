<?php

namespace Yadahan\BouncerTool\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphedByMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Silber\Bouncer\Database\Titles\AbilityTitle;

class Ability extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Silber\Bouncer\Database\Ability::class;

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
     * Set the model to be used for abilities.
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

            Select::make('Name')
                ->options(config('bouncer-tool.actions'))
                ->displayUsingLabels()
                ->sortable()
                ->showOnPreview(),

            Select::make('Entity Type')
                ->options(collect(config('bouncer-tool.entities'))->map(function ($entity, $key) {
                    $class = new $entity;

                    return $class->getMorphClass();
                })->prepend('*', 'Everything')->flip()->toArray())
                ->displayUsingLabels()
                ->sortable()
                ->showOnPreview(),

            Number::make('Entity ID')
                ->min(1)
                ->nullable()
                ->sortable()
                ->showOnPreview(),

            Boolean::make('Only Owned')
                ->sortable()
                ->showOnPreview(),

            Text::make('Title')
                ->dependsOn([
                    'name',
                    'entity_type',
                    'entity_id',
                    'only_owned'
                ], function (Text $field, NovaRequest $request, FormData $formData) {
                    $ability = new static::$model;

                    $ability->name = $formData->name;
                    $ability->entity_type = $formData->entity_type;
                    $ability->entity_id = $formData->entity_id;
                    $ability->only_owned = $formData->only_owned;

                    $field->default(AbilityTitle::from($ability)->toString());
                })
                ->rules('max:255')
                ->sortable()
                ->showOnPreview(),

            Code::make('Options')
                ->json()
                ->showOnPreview(),

            Number::make('Scope')
                ->nullable()
                ->sortable()
                ->showOnPreview(),

            MorphedByMany::make('Roles')
                ->fields(new PermissionsFields),
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
        return [
            new Filters\Action,
            new Filters\Entity,
        ];
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
        return 'bouncer-abilities';
    }
}
