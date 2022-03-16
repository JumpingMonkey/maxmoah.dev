<?php

namespace App\Nova;

use ClassicO\NovaMediaLibrary\MediaLibrary;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\NovaColorField\Color;
use Waynestate\Nova\CKEditor;
use Whitecube\NovaFlexibleContent\Flexible;

class About extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\About::class;

    public static function label()
    {
        return 'About';
    }

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Static Pages';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static $priority = 2;

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

            Text::make('Meta-title', 'meta_title')->hideFromIndex(),
            Text::make('Meta-description', 'meta_description')->hideFromIndex(),
            Text::make('Key-Words', 'key_words')->hideFromIndex(),

            Flexible::make('Content', 'content')
                ->addLayout('Atelier', 'atelier', [
                    Flexible::make('Background image', 'atelier_bg_image')
                        ->addLayout('Image', 'image', [
                            Medialibrary::make('Image','image')
                                ->rules('required'),
                            Text::make('Image title', 'image_title')
                                ->rules('required'),
                            Text::make('Image alt', 'image_alt')
                                ->rules('required')
                        ])->button('add bg image')
                        ->limit(1),
                    Boolean::make('Filter'),
                    Flexible::make('Image', 'atelier_image')
                        ->addLayout('Image', 'image', [
                            Medialibrary::make('Image','image')
                                ->rules('required'),
                            Text::make('Image title', 'image_title')
                                ->rules('required'),
                            Text::make('Image alt', 'image_alt')
                                ->rules('required')
                        ])->button('add image')
                        ->limit(1),
                    Text::make('Title', 'title')
                        ->rules('required'),
                    CKEditor::make('Description','description')
                        ->rules('required'),
                ])
                ->addLayout('Mission', 'mission', [
                    Flexible::make('Background image', 'mission_bg_image')
                        ->addLayout('Image', 'image', [
                            Medialibrary::make('Image','image')
                                ->rules('required'),
                            Text::make('Image title', 'image_title')
                                ->rules('required'),
                            Text::make('Image alt', 'image_alt')
                                ->rules('required')
                        ])->button('add bg image')
                        ->limit(1),
                    Boolean::make('Filter'),
                    Text::make('Title', 'title')
                        ->rules('required'),
                    CKEditor::make('Description','description')
                        ->rules('required'),
                    Text::make('Button title'),
                    Text::make('Button link'),
                    Color::make('Background color')
                ])
                ->addLayout('Society', 'society', [
                    Flexible::make('Background image', 'society_bg_image')
                        ->addLayout('Image', 'image', [
                            Medialibrary::make('Image','image')
                                ->rules('required'),
                            Text::make('Image title', 'image_title')
                                ->rules('required'),
                            Text::make('Image alt', 'image_alt')
                                ->rules('required')
                        ])->limit(1)
                        ->button('add bg image'),
                    Boolean::make('Filter'),
                    Text::make('Title', 'title')
                        ->rules('required'),
                    CKEditor::make('Description','description')
                        ->rules('required'),

                    Flexible::make('Title and image', 'title_and_image')
                        ->addLayout('Item', 'item', [
                            Text::make('Title', 'title')
                            ->rules('required'),
                            Flexible::make('Image', 'image')
                                ->addLayout('Image', 'image', [
                                    Medialibrary::make('Image','image')
                                    ->rules('required'),
                                    Text::make('Image title', 'image_title')
                                    ->rules('required'),
                                    Text::make('Image alt', 'image_alt')
                                    ->rules('required')
                                ])->button('add image')
                                ->limit(1)
                                ->rules('required'),
                        ])->limit(4)
                        ->button('Add title and image'),
                ])
                ->addLayout('Enviroment', 'enviroment', [
                    Flexible::make('Background image', 'enviroment_bg_image')
                        ->addLayout('Image', 'image', [
                            Medialibrary::make('Image','image')
                                ->rules('required'),
                            Text::make('Image title', 'image_title')
                                ->rules('required'),
                            Text::make('Image alt', 'image_alt')
                                ->rules('required')
                        ])->button('add bg image')
                        ->limit(1),
                    Boolean::make('Filter'),
                    Flexible::make('Image', 'enviroment_image')
                        ->addLayout('Image', 'image', [
                            Medialibrary::make('Image','image')
                                ->rules('required'),
                            Text::make('Image title', 'image_title')
                                ->rules('required'),
                            Text::make('Image alt', 'image_alt')
                                ->rules('required')
                        ])->button('add image')
                        ->limit(1),
                    Text::make('Title', 'title')
                        ->rules('required'),
                    CKEditor::make('Description','description')
                        ->rules('required'),
                    Flexible::make('Title and image', 'title_and_image')
                        ->addLayout('Item', 'item', [
                            Text::make('Title', 'title')
                                ->rules('required'),
                            Flexible::make('Image', 'image')
                                ->addLayout('Image', 'image', [
                                    Medialibrary::make('Image','image')
                                        ->rules('required'),
                                    Text::make('Image title', 'image_title')
                                        ->rules('required'),
                                    Text::make('Image alt', 'image_alt')
                                        ->rules('required')
                                ])->button('add image')
                                ->limit(1),
                        ])->limit(2)
                        ->button('Add title and image'),
                ])->button('Add'),
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
