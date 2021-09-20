<?php

namespace App\Nova;

use App\Models\Category;
use App\Models\MainPageModel;
use ClassicO\NovaMediaLibrary\MediaLibrary;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class MainPageResource extends Resource
{
    public static function label()
    {
        return 'Main';
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
    public static $model = MainPageModel::class;

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

            Flexible::make('Hero bg image', 'hero_bg_image')
                ->addLayout('Image', 'image', [
                    Medialibrary::make('Image','image')
                        ->rules('required'),
                    Text::make('Image title', 'image_title')
                        ->rules('required'),
                    Text::make('Image alt', 'image_alt')
                        ->rules('required')
                ])->button('add image')
                ->limit(1),

            Text::make('Hero title', 'hero_title'),
            Textarea::make('Hero description', 'hero_description'),
            Text::make('Hero button title', 'hero_btn_title'),

            Flexible::make('Display categories', 'display_categories')
                ->addLayout('Category', 'category', [
                    Select::make('Category', 'category_slug')->options(
                        Category::all()->pluck('category_title', 'id'),
                    ),
                ])->button('add category'),
            Flexible::make('Display pages', 'display_pages')
                ->addLayout('Page', 'page', [
                    Text::make('Page name', 'page_name'),
                    Select::make('Page link', 'page')->options([
                        '/about' => '/about',
                        '/where' => '/where',
                        '/contact' => '/contact',
                        '/customer_service' => '/customer_service',
                        '/career' => '/career',
                    ]),
                ]),


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
