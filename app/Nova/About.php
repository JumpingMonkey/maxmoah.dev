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
            Flexible::make('Контент', 'content')
                ->addLayout('Atelier', 'atelier', [
                    Medialibrary::make('Фото','image')
                        ->rules('required')
                        ->hideFromIndex(),
                    Text::make('Заголовок', 'title')
                        ->rules('required'),
                    CKEditor::make('Описание','description')
                        ->rules('required'),
                ])
                ->addLayout('Mission', 'mission', [
                    Text::make('Заголовок', 'title')
                        ->rules('required'),
                    CKEditor::make('Описание','description')
                        ->rules('required'),
                    Medialibrary::make('Фоновое изображение','image')
                        ->hideFromIndex(),
                ])
                ->addLayout('Society', 'society', [
                    Text::make('Заголовок', 'title')
                        ->rules('required'),
                    CKEditor::make('Описание','description')
                        ->rules('required'),
                    Flexible::make('Лого и описание', 'logo_and_description')
                        ->addLayout('Элемент', 'item', [
                            Text::make('Заголовок', 'title')
                            ->rules('required'),
                            Medialibrary::make('Изображение','image')
                                ->rules('required')
                                ->hideFromIndex(),
                        ])
                ])
                ->addLayout('Enviroment', 'enviroment', [
                    Medialibrary::make('Изображение', 'image')
                        ->rules('required')
                        ->hideFromIndex(),
                    Text::make('Заголовок', 'title')
                        ->rules('required'),
                    CKEditor::make('Описание','description')
                        ->rules('required'),
                    Flexible::make('Лого и описание', 'logo_and_description')
                        ->addLayout('Элемент', 'item', [
                            Text::make('Заголовок', 'title')
                                ->rules('required'),
                            Medialibrary::make('Изображение','image')
                                ->rules('required')
                                ->hideFromIndex(),
                        ])
                ])




                ->button('Добавить блок'),
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
