<?php

namespace App\Nova;


use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Waynestate\Nova\CKEditor;
use Whitecube\NovaFlexibleContent\Flexible;

class WhereToPurchase extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Static Pages';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\WhereToPurchase::class;

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
            Text::make('Title', 'title')
            ->rules('required'),
            CKEditor::make('Description', 'description')
            ->rules('required'),
            Flexible::make('Blocks Variants', 'variants')
            ->addLayout('Variant', 'variant', [
                Text::make('Title', 'title')
                ->rules('required'),
                CKEditor::make('Description', 'description')
                ->rules('required'),
                Flexible::make('Button', 'button')
                    ->addLayout('Action button', 'action_button', [
                        Text::make('CTA', 'cta')->default('SUBMIT NOW')
                    ])->button('Add button')
                    ->limit(1),
            ])->button('Add Variant')
            ->addLayout('Upcoming Events', 'upcoming_events', [
                Text::make('Title', 'title')
                ->rules('required'),
                Flexible::make('Events', 'events')
                ->addLayout('Event', 'event', [
                    Text::make('City', 'city')
                    ->rules('required'),
                    Text::make('From', 'from')
                    ->rules('required'),
                    Text::make('To', 'to')
                    ->rules('required')
                ])->button('Add Event')
                ->limit(2)
            ]),
            Flexible::make('Stores list', 'stores_list')
            ->addLayout('One store', 'one_store', [
                Text::make('Store title', 'store_title'),
                Text::make('Store city and country', 'store_city_and_country'),
                Text::make('Store address', 'store_address'),
                Text::make('Work time', 'work_time')
            ])->button('Add store')
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
