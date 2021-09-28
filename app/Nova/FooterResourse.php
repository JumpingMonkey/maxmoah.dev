<?php

namespace App\Nova;

use App\Models\Category;
use App\Models\Parts\FooterModel;
use Digitalcloud\MultilingualNova\Multilingual;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class FooterResourse extends Resource
{
    use TabsOnEdit;

    public static function label()
    {
        return 'Footer';
    }

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Parts';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = FooterModel::class;

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
            Tabs::make('Tabs', [
                Tab::make('Small footer', [
                    Text::make('Full collection button text', 'full_collection_btn_text'),
                    Text::make('Soc net button text', 'soc_net_btn_text'),
                    Flexible::make('Soc. networks', 'soc_networks')
                    ->addLayout('One soc. network', 'one_soc_net', [
                        Text::make('Soc. network title', 'soc_net_title'),
                        Text::make('Link', 'link')
                    ])->button('Add soc. network')
                ]),
                Tab::make('Large footer', [
                    Flexible::make('Large footer', 'large_footer')
                    ->addLayout('Product categories', 'product_categories', [
                        Text::make('Category block title', 'block_title'),
                        Flexible::make('Category item', 'block_items')
                            ->addLayout('Add product category', 'prod_category', [
                                Text::make('Product category title', 'item_name'),
                                Select::make('category link', 'link')->options([

                                    '/category/beauty' => '/beauty',
                                    '/category/jewelry' => '/jewelry',
                                    '/category/bags' => '/bags',

                                ])
                                    ->rules('required'),
                            ])->button('Add item'),
                    ])->button('Add category')
                    ->addLayout('Information', 'information', [
                        Text::make('Information block title', 'block_title'),
                        Flexible::make('One page', 'block_items')
                            ->addLayout('Add one page', 'one_page', [
                                Text::make('Page title', 'item_name'),
                                Select::make('Page link', 'link')->options(
                                    [
                                        '/about' => '/about',
                                        '/career' => '/career',
                                        '/where' => '/where',
                                        '/contact' => '/contact',
                                    ]
                                )
                                    ->rules('required'),
                            ])->button('Add page'),
                    ])
                    ->addLayout('Customer service', 'customer_service', [
                        Text::make('Customer service block title', 'block_title'),
                        Flexible::make('Customer service', 'block_items')
                            ->addLayout('One service', 'one_service', [
                                Text::make('Service title', 'item_name'),
                                Select::make('Service link', 'link')->options(
                                    [
                                        '/customer_service/#faq' => 'FAQ',
                                        '/customer_service/#imprint' => 'Imprint',
                                        '/customer_service/#terms_and_conditions' => 'Terms and conditions',
                                        '/customer_service/#privacy_policy' => 'Privacy policy',
                                    ]
                                )
                                    ->rules('required'),
                            ])->button('Add page'),
                    ])
                    ->addLayout('Social media', 'soc_media', [
                        Text::make('Social media block title', 'block_title'),
                        Flexible::make('One media', 'block_items')
                            ->addLayout('One media', 'one_media', [
                                Text::make('Social media title', 'item_name'),
                                Text::make('Link', 'link')
                                    ->rules('required'),
                            ])->button('Add page'),
                    ])
                ])
            ])->withToolbar(),

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
