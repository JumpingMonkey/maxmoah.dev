<?php

namespace App\Nova;

use ClassicO\NovaMediaLibrary\MediaLibrary;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\NovaColorField\Color;
use Whitecube\NovaFlexibleContent\Flexible;

class FlagPage extends Resource
{
    public static function label()
    {
        return 'Flag';
    }

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
    public static $model = \App\Models\FlagPage::class;

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

            Flexible::make('Background photo/video', 'background_photo_video')
                ->addLayout('Image', 'image', [
                    Medialibrary::make('Image','src')
                        ->rules('required'),
                    Text::make('Image title', 'title')
                        ->rules('required'),
                    Text::make('Image title', 'alt')
                        ->rules('required')
                ])
                ->addLayout('Video', 'video', [
                    Medialibrary::make('Video','src')
                        ->rules('required'),
                    Text::make('Video title', 'title')
                        ->rules('required'),
                    Text::make('Video title', 'alt')
                        ->rules('required')
                ])
                ->button('add bg image/video')
                ->limit(1),
            Color::make('Filter')->slider(),
            Text::make('Title'),
            Textarea::make('Description'),
            Textarea::make('Popup description'),
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
