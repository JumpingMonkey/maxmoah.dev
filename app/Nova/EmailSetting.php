<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class EmailSetting extends Resource
{
    public static $group = 'Form messages';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\EmailSetting::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Heading::make('Settings for the message recipient'),

            Text::make('Email for the Event registration popup','email_for_event_reg'),
            Text::make('Email for the Make request popup','email_for_make_request'),
            Text::make('Email for the Online appointment popup','email_for_online_appointment'),
            Text::make('Email for the Privat appointment popup','email_for_privat_appointment'),
            Text::make('Email for the Trunk show popup','email_for_trunk_show'),
            Text::make('Email for the Career popup','email_for_career'),

            Heading::make('Setting for the message sender'),

            Text::make('Email of message sender','email_for_send'),
            Text::make('Password (App Google)','password')
                ->withMeta(['extraAttributes' => ['type' => 'password']])
                ->hideFromIndex()->hideFromDetail(),
            Text::make('Name of message sender','name'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
