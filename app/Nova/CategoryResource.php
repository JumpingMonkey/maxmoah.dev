<?php

namespace App\Nova;

use App\Models\Category;
use App\Models\OneItemModel;
use App\Models\ProductTagModel;
use ClassicO\NovaMediaLibrary\MediaLibrary;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Waynestate\Nova\CKEditor;
use Whitecube\NovaFlexibleContent\Flexible;

class CategoryResource extends Resource
{
    public static $group = 'Products';

    public static function label(){
        return 'Subcategory page';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Category::class;

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
        $format = [
            'vertical' => 'vertical',
            'horizontal' => 'horizontal',
            'squire' => 'squire',
        ];

        $model = NovaRequest::createFrom($request)
            ->findModelQuery()
            ->first();

        if(isset($model->id)){
            $options = OneItemModel::query()->where('category_id', $model->id)->pluck('prod_title', 'id');
        } else {
            $options = ['Not exist products' => 'Not exist product'];
    }

        return [
            ID::make(__('ID'), 'id')->sortable(),
            Multilingual::make('Language'),
            Text::make('Meta-title', 'meta_title')->hideFromIndex(),
            Text::make('Meta-description', 'meta_description')->hideFromIndex(),
            Text::make('Key-Words', 'key_words')->hideFromIndex(),
            Select::make('Category tags', 'tag_id')->options(
                ProductTagModel::all()->pluck('tag_title', 'id')
            )->required()
                ->updateRules('required')
                ->creationRules('required'),
            Text::make('Subcategory title', 'category_title'),

            Slug::make('Subcategory slug(only english)', 'category_slug')
                ->from('category_title')
                ->required(),
            Flexible::make('Content', 'content')
                ->addLayout('1. Title+text', '1_title_text', [
                    Select::make('Format', 'format')
                        ->options($format),
                    Text::make('Title', 'title'),
                    Trix::make('Text', 'text')
                ])
                ->addLayout('2. Image', '2_img', [
                    Select::make('Format', 'format')
                        ->options($format),
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
                ])
                ->addLayout('3. image+title+text', '3_image_title_text', [
                    Select::make('Format', 'format')
                        ->options($format),
                    Flexible::make('Photo', 'image')
                        ->addLayout('Image', 'image', [
                            Medialibrary::make('Image','image')
                                ->rules('required'),
                            Text::make('Image title', 'image_title')
                                ->rules('required'),
                            Text::make('Image alt', 'image_alt')
                                ->rules('required')
                        ])->button('add video')
                        ->limit(1),
                    Text::make('Title', 'title'),
                    Text::make('Text', 'text')
                ])

                ->addLayout('4. First screen image', '4_first_screen_image', [
                    Flexible::make('Photo', 'image')
                        ->addLayout('Image', 'image', [
                            Medialibrary::make('Image','image')
                                ->rules('required'),
                            Text::make('Image title', 'image_title')
                                ->rules('required'),
                            Text::make('Image alt', 'image_alt')
                                ->rules('required')
                        ])->button('add video')
                        ->limit(1),
                ])
                ->addLayout('5. Video', '5_video', [
                    Flexible::make('Product photo', 'image')
                        ->addLayout('Image', 'image', [
                            Medialibrary::make('Image','image')
                                ->rules('required'),
                            Text::make('Image title', 'image_title')
                                ->rules('required'),
                            Text::make('Image alt', 'image_alt')
                                ->rules('required')
                        ])->button('add video')
                        ->limit(1),
                ])

                ->addLayout('6. Products', '6_products', [
                    Text::make('Title', 'title'),
                    Flexible::make('Product', 'product')
                        ->addLayout('Product', 'product', [
                            Select::make('Category name', 'category_name')
                            ->options(ProductTagModel::all()->pluck('tag_title', 'id')),
                            Text::make('Product name', 'prod_name'),
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
                            Text::make('Product link', 'prod_link')
                        ])
                ])
                ->addLayout('7. Product from category', '7_prod_from_category', [
                    Flexible::make('One product', 'one_prod')
                    ->addLayout('One product', 'one_product', [
                        Select::make('Product', 'product')->options(
                            $options
                        )
                    ])->button('Add product')
                ])->button('Add block')
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
