<?php

namespace App\Nova;





use ClassicO\NovaMediaLibrary\MediaLibrary;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
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
            Flexible::make('Content', 'content')
                ->addLayout('Atelier', 'atelier', [
                    Medialibrary::make('Image','image')
                        ->rules('required')
                        ->hideFromIndex(),
                    Text::make('Title', 'title')
                        ->rules('required'),
                    CKEditor::make('Description','description')
                        ->rules('required'),
                    Medialibrary::make('Background image','bg_image')
                        ->hideFromIndex(),
                ])
                ->addLayout('Mission', 'mission', [
                    Text::make('Title', 'title')
                        ->rules('required'),
                    CKEditor::make('Description','description')
                        ->rules('required'),
                    Medialibrary::make('Background image','bg_image')
                        ->hideFromIndex(),
                ])
                ->addLayout('Society', 'society', [
                    Text::make('Title', 'title')
                        ->rules('required'),
                    CKEditor::make('Description','description')
                        ->rules('required'),
                    Medialibrary::make('Background image','bg_image')
                        ->hideFromIndex(),
                    Flexible::make('Logo and description', 'logo_and_description')
                        ->addLayout('Item', 'item', [
                            Text::make('Title', 'title')
                            ->rules('required'),
                            Medialibrary::make('Image','image')
                                ->rules('required')
                                ->hideFromIndex(),

                        ])->limit(4)
                        ->button('Add'),
                ])
                ->addLayout('Enviroment', 'enviroment', [
                    Medialibrary::make('Image', 'image')
                        ->rules('required')
                        ->hideFromIndex(),
                    Text::make('Title', 'title')
                        ->rules('required'),
                    CKEditor::make('Description','description')
                        ->rules('required'),
                    Medialibrary::make('Background image','bg_image')
                        ->hideFromIndex(),
                    Flexible::make('Logo and description', 'logo_and_description')
                        ->addLayout('Item', 'item', [
                            Text::make('Title', 'title')
                                ->rules('required'),
                            Medialibrary::make('Image','image')
                                ->rules('required')
                                ->hideFromIndex(),
                        ])
                        ->limit(2)
                        ->button('Add'),
                ])




                ->button('Add'),
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
