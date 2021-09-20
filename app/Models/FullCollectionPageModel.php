<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FullCollectionPageModel extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $table = 'full_collection_page_models';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'key_words',
        'title',
        'description',
        'message_if_no_items',
        'form_title',
        'email_field_title',
        'privacy_policy_text',
        'privacy_policy_link_text',
        'filter',
    ];

    public $translatable = [
        'meta_title',
        'meta_description',
        'key_words',
        'title',
        'description',
        'message_if_no_items',
        'form_title',
        'email_field_title',
        'privacy_policy_text',
        'privacy_policy_link_text',
    ];


}
