<?php

namespace App\Nova;

use ClassicO\NovaMediaLibrary\MediaLibrary;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use NovaAttachMany\AttachMany;
use OptimistDigital\NovaColorField\Color;
use Whitecube\NovaFlexibleContent\Flexible;

class OneNews extends Resource
{
    public static $group = 'News';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\OneNews::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'news_title';

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
        $format = [
            'vertical' => 'vertical',
            'horizontal' => 'horizontal',
            'squire' => 'squire',
        ];
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Multilingual::make('Language'),

            Heading::make('Meta info'),
            Text::make('Meta-title', 'meta_title')->hideFromIndex(),
            Text::make('Meta-description', 'meta_description')->hideFromIndex(),
            Text::make('Key-Words', 'key_words')->hideFromIndex(),
            Heading::make('Information to the news page'),
//            AttachMany::make('News category', 'newsCategory', \App\Nova\NewsCategory::class),
            BelongsTo::make('Category', 'newsOneCategory', 'App\Nova\NewsCategory'),
            Text::make('Title on the news page', 'title_on_the_news_page'),
            Textarea::make('Description on the news page'),
            Date::make('Publication date')->nullable(),
            Heading::make('Content'),
            Text::make('News title'),
            Slug::make('Slug')->from('news_title'),
            Flexible::make('Blocks')->hideFromIndex()
                ->addLayout('Main screen', 'main_screen', [
                    Boolean::make('Filter'),
                    Flexible::make('Image or video', 'bg_image_video')
                        ->addLayout('Image', 'image', [
                            Medialibrary::make('Item','src')
                                ->rules('required'),
                            Text::make('Item title', 'title')
                                ->rules('required'),
                            Text::make('Item alt', 'alt')
                                ->rules('required')
                        ])
                        ->addLayout('Video', 'video', [
                            Medialibrary::make('Item','src')
                                ->rules('required'),
                            Text::make('Item title', 'title')
                                ->rules('required'),
                            Text::make('Item alt', 'alt')
                                ->rules('required')
                        ])
                        ->button('add bg image/video')
                        ->limit(1),
                    Textarea::make('Text'),
                ])
                ->addLayout('Title + text', 'title_text', [
                    Select::make('Block type')
                    ->options($format),
                    Text::make('Title'),
                    Textarea::make('Text'),
                    Flexible::make('Background color', 'background_color')
                        ->addLayout('Background color', 'background_color', [
                            Color::make('Background color', 'background_color')->sketch()->autoHidePicker()->saveAs('hex'),
                        ])->button('add color')->limit(1),
                    Flexible::make('Text color', 'text_color')
                        ->addLayout('Text color', 'text_color', [
                            Color::make('Text color', 'text_color')->sketch()->autoHidePicker()->saveAs('hex'),
                        ])->button('add color')->limit(1),
                ])
                ->addLayout('Image or video', 'image_or_video', [
                    Select::make('Block type')
                        ->options($format),
                    Boolean::make('Filter'),
                    Flexible::make('Image or video', 'bg_image_video')
                        ->addLayout('Image', 'image', [
                            Medialibrary::make('Item','src')
                                ->rules('required'),
                            Text::make('Item title', 'title')
                                ->rules('required'),
                            Text::make('Item alt', 'alt')
                                ->rules('required')
                        ])
                        ->addLayout('Video', 'video', [
                            Medialibrary::make('Item','src')
                                ->rules('required'),
                            Text::make('Item title', 'title')
                                ->rules('required'),
                            Text::make('Item alt', 'alt')
                                ->rules('required')
                        ])
                        ->button('add bg image/video')
                        ->limit(1),
                ])
                ->addLayout('Image or video + title + text', 'image_video_title_text', [
                    Select::make('Block type')
                        ->options($format),
                    Flexible::make('Image or video', 'bg_image_video')
                        ->addLayout('Image', 'image', [
                            Medialibrary::make('Item','src')
                                ->rules('required'),
                            Text::make('Item title', 'title')
                                ->rules('required'),
                            Text::make('Item alt', 'alt')
                                ->rules('required')
                        ])
                        ->addLayout('Video', 'video', [
                            Medialibrary::make('Item','src')
                                ->rules('required'),
                            Text::make('Item title', 'title')
                                ->rules('required'),
                            Text::make('Item alt', 'alt')
                                ->rules('required')
                        ])
                        ->button('add bg image/video')
                        ->limit(1),
                    Text::make('Title'),
                    Textarea::make('Text'),
                    Flexible::make('Background color', 'background_color')
                        ->addLayout('Background color', 'background_color', [
                            Color::make('Background color', 'background_color')->sketch()->autoHidePicker()->saveAs('hex'),
                        ])->button('add color')->limit(1),
                    Flexible::make('Text color', 'text_color')
                        ->addLayout('Text color', 'text_color', [
                            Color::make('Text color', 'text_color')->sketch()->autoHidePicker()->saveAs('hex'),
                        ])->button('add color')->limit(1),
                ])
                ->addLayout('Fullscreen video', 'fullscreen_video', [
                    MediaLibrary::make('Video', 'src'),
                    Text::make('Item title', 'title')
                        ->rules('required'),
                    Text::make('Item alt', 'alt')
                        ->rules('required'),
                    Boolean::make('Filter'),
                ])
            ->button('add block')
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
