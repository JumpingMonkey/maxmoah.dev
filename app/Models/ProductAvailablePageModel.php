<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProductAvailablePageModel extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $table = 'product_available_page_models';

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
