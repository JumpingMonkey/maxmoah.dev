<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class MainPageModel extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

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
    ];

    public static function normalizeData($object)
    {

//        $contentItems = [];
//        if (isset($object['content'])){
//            foreach ($object['content'] as $key => $item){
//
//                if ($item['key']){
//                    $contentItems[$key . " : " . $item['layout']] = $item['attributes'];
//                }
//
//
//            }
//            $object['content'] = $contentItems;
//        }

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
