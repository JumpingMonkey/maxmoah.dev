<?php

namespace App\Nova;

use App\Models\MakeRequestPageModel;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class MakeRequestPage extends Resource
{

    public static $group = 'Forms content';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = MakeRequestPageModel::class;

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
            Text::make('Message field title', 'message_field_title'),
            Flexible::make('Subject variants', 'subject_variant')
                ->addLayout('Subject', 'subject', [
                    Text::make('Subject', 'subject')
                ])->button('Add subject variant'),
            Text::make('Privacy policy label', 'privacy_policy_label'),
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
