<?php

namespace Yadahan\BouncerTool\Nova;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;

class PermissionsFields
{
    /**
     * Get the pivot fields for the relationship.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            Boolean::make('Forbidden'),
            Text::make('Scope')
                ->sortable()
                ->rules('nullable', 'integer'),
        ];
    }
}
