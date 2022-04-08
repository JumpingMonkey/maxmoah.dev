<?php

namespace App\Nova;

use App\Models\Parts\HeaderModel;
use Carbon\Language;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class HeaderResource extends Resource
{
    public static function label()
    {
        return 'Header';
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
    public static $model = HeaderModel::class;

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

            Text::make('Site Name', 'site_name'),
            Text::make('Menu name', 'menu_name'),
            Text::make('Make_appointment', 'make_appointment'),

            Text::make('Burger close_button_label', 'burger_close_btn_label'),

            Flexible::make('Main nav', 'header_navigation')
                ->addLayout('Add page', 'header_page_item', [
                    Text::make('Menu item name', 'name'),
                    Select::make('Item link', 'link')->options(
                        [
                            '/main' => '/',
                            '/full-collection' => '/full-collection',
                            '/product-available' => '/product-available',
                            '/news' => '/news'
                        ]
                    )
                        ->displayUsingLabels()
                        ->rules('required'),
                ])->button('Add page for menu')
                ->addLayout('Add product category', 'header_category', [
                    Text::make('Menu item name', 'name'),
                    Select::make('Item link', 'link')->options(
                        [
                            '/category/beauty' => '/beauty',
                            '/category/jewelry' => '/jewelry',
                            '/category/bags' => '/bags',
                        ]
                    )
                        ->displayUsingLabels()
                        ->rules('required'),
                ])->button('Add category for menu'),


            Flexible::make('Sub nav', 'sub_header_navigation')
                ->addLayout('Menu item', 'sub_header_navigation_item', [
                    Text::make('Menu item name', 'name'),

                    Select::make('Item link', 'link')->options(
                        [
                            '/about' => '/about',
                            '/career' => '/career',
                            '/where' => '/where',
                            '/contact' => '/contact',
                            '/customer-service/#faq' => 'FAQ',
                            '/customer-service/#imprint' => 'Imprint',
                            '/customer-service/#terms-and-conditions' => 'Terms and conditions',
                            '/customer-service/#privacy-policy' => 'Privacy policy',
                        ]
                    )
                        ->displayUsingLabels()
                        ->rules('required'),
                ])->button('Add menu item'),

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
