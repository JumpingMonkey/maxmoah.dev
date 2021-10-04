<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class MainPageModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'main_page_models';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'key_words',
        'hero_bg_image',
        'hero_title',
        'hero_description',
        'hero_btn_title',
        'display_categories',
        'display_pages',
    ];

    public $translatable = [
        'meta_title',
        'meta_description',
        'key_words',
        'hero_title',
        'hero_description',
        'hero_btn_title',
        'display_categories',
        'display_pages',
    ];

    public $mediaToUrl = [
        'hero_bg_image',
        'image',
    ];

    public static function normalizeData($object)
    {
        self::getNormalizedField($object, 'hero_bg_image', 'image', 'true', 'true');
        self::getNormalizedField($object, 'display_categories', 'category_name', 'true', 'true');
        self::getNormalizedField($object, 'display_pages', 'page_name', 'true', 'true');

        return $object;
    }

    public function getFullData()
    {
        try {

            $data = $this->getAllWithMediaUrlWithout(['id', 'created_at', 'updated_at']);
            return self::normalizeData($data);

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }

    }
}
