<?php

namespace App\Nova;

use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Waynestate\Nova\CKEditor;
use Whitecube\NovaFlexibleContent\Flexible;

class CustomerServicePage extends Resource
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
    public static $model = \App\Models\CustomerServicePage::class;

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

            Text::make('Sidebar title', 'sidebar_title'),
            Text::make('Need help title', 'need_help_title')->hideFromIndex(),
            Text::make('E-mail', 'email')->hideFromIndex(),
            Text::make('Tel', 'tel')->hideFromIndex(),

            Flexible::make('Services', 'services')
            ->addLayout('Imprint', 'imprint', [
                Text::make('Title', 'title'),
                CKEditor::make('Address', 'address'),
                Text::make('Tel', 'tel'),
                Text::make('E-mail', 'email'),
                Text::make('Gesch', 'gesch'),
                CKEditor::make('Long text', 'long_text')
            ])
            ->addLayout('FAQ', 'faq', [
                Text::make('Title', 'title'),
                Flexible::make('Questions', 'questions')
                    ->addLayout('Question - answer', 'question_answer', [
                        Text::make('Question', 'question'),
                        CKEditor::make('Answer', 'answer'),
                    ])->button('Add question')
            ])
            ->addLayout('Terms and conditions', 'terms_and_conditions', [
                Text::make('Title', 'title'),
                Textarea::make('Description', 'description'),
                CKEditor::make('Content', 'content')
            ])
            ->addLayout('Privacy policy', 'privacy_policy', [
                Text::make('Title', 'title'),
                CKEditor::make('Content', 'content')
            ])
            ->addLayout('Care instructions', 'care_instructions', [
                Text::make('Title', 'title'),
                Flexible::make('Questions', 'questions')
                    ->addLayout('Question - answer', 'question_answer', [
                        Text::make('Question', 'question'),
                        CKEditor::make('Answer', 'answer'),
                    ])->button('Add question')
            ])
            ->button('Add service')

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
