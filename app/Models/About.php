<?php

namespace App\Models;

use Anrail\NovaMediaLibraryTools\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $table = "abouts";

    protected $fillable = [
        'content',
        'seo_title',
        'meta_description',
        'key_words'
        ];

    public $translatable = [
        'content',
        'seo_title',
        'meta_description',
        'key_words'
    ];

    public $mediaToUrl = [
        'image'
    ];

}
