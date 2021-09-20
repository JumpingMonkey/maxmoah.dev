<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $fillable = [
        'meta_title',
        'meta_description',
        'key_words',
        'category_title',
        'category_slug',
        'content'
    ];

    public $translatable = [
        'meta_title',
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

    public function products(){

        return $this->hasMany(OneItemModel::class);

    }

    public static function normalizeData($object){

//        $contentItems = [];
//        if (isset($object['content'])){
//            foreach ($object['content'] as $key => $item){
//
//                if ($item['key']){
//                    $contentItems[$key . " : " . $item['layout']] = $item['attributes'];
//                }
//
//            }
//            $object['content'] = $contentItems;
//        }

        return $object;
    }


    public static function getFullData(self $object) {
        try{

            $data = $object->getAllWithMediaUrlWithout(['id', 'created_at', 'updated_at']);

            return self::normalizeData($data);

        } catch (\Exception $ex){
            throw new ModelNotFoundException();
        }
    }

}
