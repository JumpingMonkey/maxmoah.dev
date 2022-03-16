<?php

namespace App\Nova;

use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class Contact extends Resource
{
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
    public static $model = \App\Models\Contact::class;

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
            Text::make('Meta-title', 'meta_title')->hideFromIndex(),
            Text::make('Meta-description', 'meta_description')->hideFromIndex(),
            Text::make('Key-Words', 'key_words')->hideFromIndex(),
            Text::make('Title', 'title')->hideFromIndex(),
            Text::make('Description', 'description')->hideFromIndex(),


            Flexible::make('Subject field', 'subject_field')
            ->addLayout('Subject', 'subject', [
                Text::make('Subject title', 'subj_title'),
            ])->button('Add subject variant'),
            Text::make('Button title', 'button_title'),
            Text::make('Phone number', 'phone_number')->rules('required'),
            Text::make('Email for press inquires', 'email_for_press_inquires'),
            Text::make('Email general', 'email_general')->rules('required'),
        ];
    }
}
