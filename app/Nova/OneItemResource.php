<?php

namespace App\Nova;

use App\Models\Category;
use App\Models\OneItemModel;
use App\Models\ProductTagModel;
use ClassicO\NovaMediaLibrary\MediaLibrary;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\NovaColorField\Color;
use Waynestate\Nova\CKEditor;
use Whitecube\NovaFlexibleContent\Flexible;

class OneItemResource extends Resource
{
    public static $group = 'Products';

    public static function label(){
        return 'One item';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = OneItemModel::class;

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
        $photoformat = [
            'vertical' => 'vertical',
            'horizontal' => 'horizontal',
            'squire' => 'squire',
        ];

        return [
            ID::make(__('ID'), 'id')->sortable(),
            Multilingual::make('Language'),

            Text::make('Meta-title', 'meta_title')->hideFromIndex(),
            Text::make('Meta-description', 'meta_description')->hideFromIndex(),
            Text::make('Key-Words', 'key_words')->hideFromIndex(),

            Text::make('Zoom in btn-title', 'zoom_in_btn_title')->hideFromIndex(),
            Flexible::make('Product photo', 'prod_photo')
                ->addLayout('Image', 'image', [
                    Medialibrary::make('Image','src')
                        ->rules('required'),
                    Text::make('Image title', 'title')
                        ->rules('required'),
                    Text::make('Image alt', 'alt')
                        ->rules('required')
                ])->button('add image')
                ->limit(5),

            Select::make('Category tags', 'tag_id')->options(
                ProductTagModel::all()->pluck('tag_title', 'id')
            )->required()
            ->updateRules('required')
            ->creationRules('required'),

            Select::make('Product category', 'category_id')->options(
                Category::all()->pluck('category_title', 'id')
            )->required()
                ->updateRules('required')
                ->creationRules('required'),

            Text::make('Product title', 'prod_title'),

            Slug::make('Product slug/link(only english)', 'prod_slug')
                ->from('prod_title')
                ->rules('required')
                ->creationRules('unique:one_item_models')->hideFromIndex(),

            Boolean::make('Available', 'available')->hideFromIndex()
                ->trueValue('true')
                ->falseValue('false'),
            Boolean::make('Customize', 'customize')->hideFromIndex()
                ->trueValue('true')
                ->falseValue('false'),

            Text::make('Ready to order',  'ready_to_order'),

            Text::make('Price', 'prod_price')->default(function (){return 'Price on request';})->hideFromIndex(),
            Flexible::make('Color', 'color')
                ->addLayout('one color', 'one_color', [
                    Color::make('Color', 'color_one')->sketch()->autoHidePicker()->saveAs('hex'),
                    Medialibrary::make('Image','src')
                        ->rules('required'),
                    Text::make('Price')
                ])
                ->addLayout('two colors', 'two_colors', [
                    Color::make('Color 1', 'color_one')->sketch()->autoHidePicker()->saveAs('hex'),
                    Color::make('Color 2', 'color_two')->sketch()->autoHidePicker()->saveAs('hex'),
                    Medialibrary::make('Image','src')
                        ->rules('required'),
                    Text::make('Price')
                ])->button('add color'),


            Flexible::make('Background img for first screen', 'bg_img_first_screen')
                ->addLayout('Image', 'image', [
                    Boolean::make('Filter'),
                    Medialibrary::make('Image','src')
                        ->rules('required'),
                    Text::make('Image title', 'image_title')
                        ->rules('required'),
                    Text::make('Image alt', 'image_alt')
                        ->rules('required')
                ])->button('add image')
                ->limit(1),

            Flexible::make('Background video for first screen', 'bg_video_first_screen')
                ->addLayout('Video', 'video', [
                    Boolean::make('Filter'),
                    Medialibrary::make('Video','src'),
//                    Text::make('Video link', 'video_link'),
                    Text::make('Video title', 'video_title')
                        ->rules('required'),
                    Text::make('Video alt', 'video_alt')
                        ->rules('required')
                ])->button('add video')
                ->limit(1),

            Flexible::make('Content', 'content')
            ->addLayout('1. Title+text', '1_title_text', [
                Text::make('Title', 'title'),
                CKEditor::make('Description', 'desc'),
                Flexible::make('Background color', 'background_color')
                    ->addLayout('Background color', 'background_color', [
                        Color::make('Background color', 'background_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
                Flexible::make('Text color', 'text_color')
                    ->addLayout('Text color', 'text_color', [
                        Color::make('Text color', 'text_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
            ])
            ->addLayout('2. Img+title+text', '2_img_title_text', [
                Flexible::make('Img', 'img')
                    ->addLayout('Image', 'image', [
                        Select::make('Photo format', 'foto_format')
                            ->options($photoformat),
                        Medialibrary::make('Image','image')
                            ->rules('required'),
                        Text::make('Image title', 'image_title')
                            ->rules('required'),
                        Text::make('Image alt', 'image_alt')
                            ->rules('required')
                    ])->button('add image')
                    ->limit(1),
                Text::make('Title', 'title'),
                CKEditor::make('Description', 'desc'),
                Flexible::make('Background color', 'background_color')
                    ->addLayout('Background color', 'background_color', [
                        Color::make('Background color', 'background_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
                Flexible::make('Text color', 'text_color')
                    ->addLayout('Text color', 'text_color', [
                        Color::make('Text color', 'text_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
            ])
            ->addLayout('3. Twins block', '3_twins_block', [
                Flexible::make('Left img', 'lt_img')
                    ->addLayout('Image', 'image', [
                        Medialibrary::make('Image','image')
                            ->rules('required'),
                        Text::make('Image title', 'image_title')
                            ->rules('required'),
                        Text::make('Image alt', 'image_alt')
                            ->rules('required')
                    ])->button('add image')
                    ->limit(1),
                Text::make('Left title', 'lf_title'),
                CKEditor::make('Left description', 'lt_desc'),
                Text::make('Left btn', 'lt_btn'),
                Select::make('Left Btn link', 'lt_btn_link')
                    ->options($this->formLinks),
                Flexible::make('Right img', 'rt_img')
                    ->addLayout('Image', 'image', [
                        Medialibrary::make('Image','image')
                            ->rules('required'),
                        Text::make('Image title', 'image_title')
                            ->rules('required'),
                        Text::make('Image alt', 'image_alt')
                            ->rules('required')
                    ])->button('add image')
                    ->limit(1),
                Text::make('Right title', 'rt_title'),
                CKEditor::make('Right description', 'rt_desc'),
                Text::make('Right btn', 'rt_btn'),
                Select::make('Right btn link', 'rt_btn_link')
                    ->options($this->formLinks),
                Flexible::make('Background color', 'background_color')
                    ->addLayout('Background color', 'background_color', [
                        Color::make('Background color', 'background_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
                Flexible::make('Text color', 'text_color')
                    ->addLayout('Text color', 'text_color', [
                        Color::make('Text color', 'text_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
            ])
            ->addLayout('4. Title+text+btn+img(right)', '4_title_txt_btn_img_right', [
                Flexible::make('Img', 'img')
                    ->addLayout('Image', 'image', [
                        Select::make('Photo format', 'foto_format')
                            ->options($photoformat),
                        Medialibrary::make('Image','image')
                            ->rules('required'),
                        Text::make('Image title', 'image_title')
                            ->rules('required'),
                        Text::make('Image alt', 'image_alt')
                            ->rules('required')
                    ])->button('add image')
                    ->limit(1),
                Text::make('Title', 'title'),
                CKEditor::make('Description', 'desc'),
                Text::make('Btn', 'btn'),
                Select::make('link', 'link')
                    ->options($this->formLinks),
                Flexible::make('Background color', 'background_color')
                    ->addLayout('Background color', 'background_color', [
                        Color::make('Background color', 'background_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
                Flexible::make('Text color', 'text_color')
                    ->addLayout('Text color', 'text_color', [
                        Color::make('Text color', 'text_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
            ])
            ->addLayout('5. Text+text', '5_text_text', [
                Text::make('Title', 'title'),
                CKEditor::make('Text 1', 'desc_1'),
                CKEditor::make('Text 2', 'desc_2'),
                Flexible::make('Background color', 'background_color')
                    ->addLayout('Background color', 'background_color', [
                        Color::make('Background color', 'background_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
                Flexible::make('Text color', 'text_color')
                    ->addLayout('Text color', 'text_color', [
                        Color::make('Text color', 'text_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
            ])
            ->addLayout('6. Title+text+btn+img(left)', '6_title_txt_btn_img_left', [
                Flexible::make('Img', 'img')
                    ->addLayout('Image', 'image', [
                        Select::make('Photo format', 'foto_format')
                            ->options($photoformat),
                        Medialibrary::make('Image','image')
                            ->rules('required'),
                        Text::make('Image title', 'image_title')
                            ->rules('required'),
                        Text::make('Image alt', 'image_alt')
                            ->rules('required')
                    ])->button('add image')
                    ->limit(1),
                Text::make('Title', 'title'),
                CKEditor::make('Description', 'desc'),
                Text::make('Btn', 'btn'),
                Select::make('Btn link', 'btn_link')
                    ->options($this->formLinks),
                Flexible::make('Background color', 'background_color')
                    ->addLayout('Background color', 'background_color', [
                        Color::make('Background color', 'background_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
                Flexible::make('Text color', 'text_color')
                    ->addLayout('Text color', 'text_color', [
                        Color::make('Text color', 'text_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
            ])
            ->addLayout('7. Img+title+text+btn', '7_img_title_text_btn', [
                Flexible::make('Img', 'img')
                    ->addLayout('Image', 'image', [
                        Medialibrary::make('Image','image')
                            ->rules('required'),
                        Text::make('Image title', 'image_title')
                            ->rules('required'),
                        Text::make('Image alt', 'image_alt')
                            ->rules('required')
                    ])->button('add image')
                    ->limit(1),
                Text::make('Title', 'title'),
                CKEditor::make('Description', 'desc'),
                Text::make('Btn', 'btn'),
                Select::make('Btn link', 'btn_link')
                    ->options($this->formLinks),
                Flexible::make('Background color', 'background_color')
                    ->addLayout('Background color', 'background_color', [
                        Color::make('Background color', 'background_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
                Flexible::make('Text color', 'text_color')
                    ->addLayout('Text color', 'text_color', [
                        Color::make('Text color', 'text_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
            ])
            ->addLayout('8. Img(right)+title+text', '8_img_right_title_text', [
                Flexible::make('Img', 'img')
                    ->addLayout('Image', 'image', [
                        Select::make('Photo format', 'foto_format')
                            ->options($photoformat),
                        Medialibrary::make('Image','image')
                            ->rules('required'),
                        Text::make('Image title', 'image_title')
                            ->rules('required'),
                        Text::make('Image alt', 'image_alt')
                            ->rules('required')
                    ])->button('add image')
                    ->limit(1),
                Text::make('Title', 'title'),
                CKEditor::make('Description', 'desc'),
                Flexible::make('Background color', 'background_color')
                    ->addLayout('Background color', 'background_color', [
                        Color::make('Background color', 'background_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
                Flexible::make('Text color', 'text_color')
                    ->addLayout('Text color', 'text_color', [
                        Color::make('Text color', 'text_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
            ])
//            ->addLayout('9. Loop+title+text', '9_loop_title_text', [
//                Flexible::make('Loop', 'loop')
//                    ->addLayout('Image', 'image', [
//                        Medialibrary::make('Image','image')
//                            ->rules('required'),
//                        Text::make('Image title', 'image_title')
//                            ->rules('required'),
//                        Text::make('Image alt', 'image_alt')
//                            ->rules('required')
//                    ])->button('add image')
//                    ->limit(5),
//                Text::make('Title', 'title'),
//                Text::make('Description', 'desc'),
//            ])
            ->addLayout('10. title+text+img+img', '10_title_text_img_img', [
                Text::make('Title', 'title'),
                CKEditor::make('Description', 'desc'),
                Flexible::make('Img 1', 'img_1')
                    ->addLayout('Image', 'image', [
                        Select::make('Photo format', 'foto_format')
                            ->options([
                                'Wide' => 'wide',
                                'Tight' => 'tight'
                            ]),
                        Medialibrary::make('Image','image')
                            ->rules('required'),
                        Text::make('Image title', 'image_title')
                            ->rules('required'),
                        Text::make('Image alt', 'image_alt')
                            ->rules('required')
                    ])->button('add image')
                    ->limit(1),
                Flexible::make('Img 2', 'img_2')
                    ->addLayout('Image', 'image', [
                        Select::make('Photo format', 'foto_format')
                            ->options([
                                'Wide' => 'wide',
                                'Tight' => 'tight'
                            ]),
                        Medialibrary::make('Image','image')
                            ->rules('required'),
                        Text::make('Image title', 'image_title')
                            ->rules('required'),
                        Text::make('Image alt', 'image_alt')
                            ->rules('required')
                    ])->button('add image')
                    ->limit(1),
                Flexible::make('Background color', 'background_color')
                    ->addLayout('Background color', 'background_color', [
                        Color::make('Background color', 'background_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
                Flexible::make('Text color', 'text_color')
                    ->addLayout('Text color', 'text_color', [
                        Color::make('Text color', 'text_color')->sketch()->autoHidePicker()->saveAs('hex'),
                    ])->button('add color')->limit(1),
            ])
            ->addLayout('11. img+title+4text', '11_img_title_4text', [
                Flexible::make('Img', 'img')
                    ->addLayout('Image', 'image', [
                        Medialibrary::make('Image','image')
                            ->rules('required'),
                        Text::make('Image title', 'image_title')
                            ->rules('required'),
                        Text::make('Image alt', 'image_alt')
                            ->rules('required')
                    ])->button('add image')
                    ->limit(1),
                Text::make('Title', 'title'),

                Text::make('Size title', 'size_title'),
                Text::make('Size description', 'size'),
                Text::make('Weight title', 'weight_title'),
                Text::make('Weight description', 'weight'),
                Text::make('Material title', 'material_title'),
                Text::make('Material description', 'material'),
                Text::make('Chain title', 'chain_title'),
                Text::make('Chain description', 'chain'),
            ])
//            ->addLayout('12. title+text+img+title+text+btn', '12_title_text_img_title_text_btn', [
//                Text::make('Title top', 'title_top'),
//                Text::make('Description top', 'desc_top'),
//                Flexible::make('Img', 'img')
//                    ->addLayout('Image', 'image', [
//                        Medialibrary::make('Image','image')
//                            ->rules('required'),
//                        Text::make('Image title', 'image_title')
//                            ->rules('required'),
//                        Text::make('Image alt', 'image_alt')
//                            ->rules('required')
//                    ])->button('add image')
//                    ->limit(1),
//
//                Text::make('Title bottom', 'title_bottom'),
//                Text::make('Description bottom', 'desc_bottom'),
//                Text::make('Btn', 'btn'),
//                Text::make('Btn link', 'btn_link'),
//            ])
//            ->addLayout('13. products', '13_prod', [
//                Flexible::make('Product', 'prod')
//                    ->addLayout('One product', 'one_prod', [
//                        Select::make('Prod', 'prod')->options(
//                            OneItemModel::all()->pluck('prod_title','id')
//                        ),
//                ]),
//            ])
//                ->addLayout('14. form', '14_form', [
//                    Text::make('Form title', 'form_title'),
//                    Text::make('Email field title', 'email_field_title'),
//                    Text::make('Description', 'desc'),
//                    Text::make('Privacy policy text', 'privacy_policy_text'),
//                    Text::make('Privacy policy link text', 'privacy_policy_link_text'),
//
//                ])
                ->addLayout('15. Title+text+horizontal_image', '15_title_text_horizontal_img', [
                    Text::make('Title', 'title'),
                    CKEditor::make('Description', 'desc'),
                    Flexible::make('Img 1', 'img_1')
                        ->addLayout('Image', 'image', [
                            Select::make('Photo format', 'foto_format')
                                ->options([
                                    'Wide' => 'wide',
                                    'Tight' => 'tight'
                                ]),
                            Medialibrary::make('Image','image')
                                ->rules('required'),
                            Text::make('Image title', 'image_title')
                                ->rules('required'),
                            Text::make('Image alt', 'image_alt')
                                ->rules('required')
                        ])->button('add image')
                        ->limit(1),
                    Flexible::make('Background color', 'background_color')
                        ->addLayout('Background color', 'background_color', [
                            Color::make('Background color', 'background_color')->sketch()->autoHidePicker()->saveAs('hex'),
                        ])->button('add color')->limit(1),
                    Flexible::make('Text color', 'text_color')
                        ->addLayout('Text color', 'text_color', [
                            Color::make('Text color', 'text_color')->sketch()->autoHidePicker()->saveAs('hex'),
                        ])->button('add color')->limit(1),
                    ])
                ->addLayout('16. Gallery popup', '16_gallery_popup', [
                    Flexible::make('Img', 'loop')
                        ->addLayout('Vertical image', 'vertical_image', [
                            Select::make('Photo format', 'foto_format')
                                ->options($photoformat),
                            Medialibrary::make('Image','image')
                                ->rules('required'),
                            Text::make('Image title', 'image_title')
                                ->rules('required'),
                            Text::make('Image alt', 'image_alt')
                                ->rules('required')
                        ])->button('add image')
                        ->limit(10),
                ])
                ->addLayout('17.Product colors', '17_product_colors', [
                    Flexible::make('Img', 'loop')
                        ->addLayout('Image', 'image', [
                            Medialibrary::make('Image','image')
                                ->rules('required'),
                            Text::make('Title', 'title'),
                            Text::make('Image title', 'image_title')
                                ->rules('required'),
                            Text::make('Image alt', 'image_alt')
                                ->rules('required')
                        ])->button('add image')
                        ->limit(10),
                    Text::make('Title', 'title'),
                    CKEditor::make('Description', 'desc'),
                ])
                ->addLayout('18. horizontal image/video', '18_horizontal_image_video', [
                    Flexible::make('Image or video', 'image_video')
                        ->addLayout('Image', 'image', [
                            Medialibrary::make('Image','src')
                                ->rules('required'),
                            Text::make('Image title', 'title')
                                ->rules('required'),
                            Text::make('Image alt', 'alt')
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
                        ->button('add item')
                        ->limit(1),
                    Flexible::make('Background color', 'background_color')
                        ->addLayout('Background color', 'background_color', [
                            Color::make('Background color', 'background_color')->sketch()->autoHidePicker()->saveAs('hex'),
                        ])->button('add color')->limit(1),
                    Flexible::make('Text color', 'text_color')
                        ->addLayout('Text color', 'text_color', [
                            Color::make('Text color', 'text_color')->sketch()->autoHidePicker()->saveAs('hex'),
                        ])->button('add color')->limit(1),
                ])
                ->addLayout('19.Text+btn in the middle', '19_text_btn_in_the_middle', [
                    Text::make('Title', 'title'),
                    Textarea::make('Description', 'desc'),
                    Text::make('Btn', 'btn_title'),
                    Select::make('Btn link', 'btn_link')
                        ->options($this->formLinks),
                    Flexible::make('Background color', 'background_color')
                        ->addLayout('Background color', 'background_color', [
                            Color::make('Background color', 'background_color')->sketch()->autoHidePicker()->saveAs('hex'),
                        ])->button('add color')->limit(1),
                    Flexible::make('Text color', 'text_color')
                        ->addLayout('Text color', 'text_color', [
                            Color::make('Text color', 'text_color')->sketch()->autoHidePicker()->saveAs('hex'),
                        ])->button('add color')->limit(1),
                ])
                ->addLayout('20. Products', '20_products', [
                    Select::make('Product 1', 'product_1')->options(
                        OneItemModel::all()->pluck('prod_title', 'id')
                    ),
                    Select::make('Product 2', 'product_2')->options(
                        OneItemModel::all()->pluck('prod_title', 'id')
                    ),
                ])

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
