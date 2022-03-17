<?php

namespace App\Nova;

use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class PrivateAppointment extends Resource
{
    public static $group = 'Forms content';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\PrivateAppointment::class;

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
            Multilingual::make('Language'),
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Title', 'title'),
            Text::make('Description', 'description'),

            Text::make('Name field title', 'name_field_title'),
            Text::make('E-mail field title', 'email_field_title'),
            Text::make('Country field title', 'country_field_title'),
            Text::make('Phone field title', 'phone_field_title'),
            Text::make('Calendar title', 'calendar_title'),

            Text::make('Time field title', 'time_field_title'),

            Text::make('Privacy policy text', 'privacy_policy_text'),
            Text::make('Privacy policy link text', 'privacy_policy_link_text'),
            Text::make('Button title', 'button_title'),
            Text::make('Close button title', 'close_button_title')

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
