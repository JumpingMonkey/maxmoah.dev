<?php

namespace App\Nova;

use App\Models\ProductAvailablePageModel;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProductAvailablePage extends Resource
{
    public static function label()
    {
        return 'Product Available Page';
    }
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Products';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ProductAvailablePageModel::class;

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
            Multilingual::make('Language'),

            Text::make('Meta-title', 'meta_title')->hideFromIndex(),
            Text::make('Meta-description', 'meta_description')->hideFromIndex(),
            Text::make('Key-Words', 'key_words')->hideFromIndex(),

            Text::make('Title', 'title'),
            Textarea::make('Description', 'description'),

            Text::make('Message in the no items in stock', 'message_if_no_items'),

            Text::make('Form title', 'form_title'),
            Text::make('Email field title', 'email_field_title'),
            Text::make('Privacy policy text', 'privacy_policy_text'),
            Text::make('Privacy policy link text', 'privacy_policy_link_text'),

            Boolean::make('Activate filter', 'filter'),
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
