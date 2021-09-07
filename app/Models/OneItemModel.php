<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneItemModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'seo_title',
        'meta_description',
        'key_words',
        'zoom_in_btn_title',
        'prod_photo',
        'prod_category',
        'prod_title',
        'available',
        'prod_price',
        'bg_img_first_screen',
        'content'
    ];

    public $translatable = [
        'seo_title',
        'meta_description',
        'key_words',
        'zoom_in_btn_title',
        'prod_category',
        'prod_title',
        'available',
        'prod_price',
        'content'
    ];

    public $mediaToUrl = [
        'content',
        'prod_photo',
        'bg_img_first_screen',
    ];
}
