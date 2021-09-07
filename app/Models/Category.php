<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'seo_title',
        'meta_description',
        'key_words',
        'category_title',
        'content'
    ];

    public $translatable = [
        'seo_title',
        'meta_description',
        'key_words',
        'category_title',
        'content'
    ];

    public $mediaToUrl = [
        'content',
        'prod_photo',
        'bg_img_first_screen',
    ];
}
