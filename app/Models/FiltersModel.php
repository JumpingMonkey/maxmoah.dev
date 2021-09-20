<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FiltersModel extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $table = 'filters_models';

    protected $fillable = [
        'prod_category_filter_title',
        'sort_title',
        'price_highest_label',
        'price_lowest_label',
        'newest_label',
    ];

    protected $translatable = [
        'prod_category_filter_title',
        'sort_title',
        'price_highest_label',
        'price_lowest_label',
        'newest_label',
    ];
}
