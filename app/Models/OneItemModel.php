<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class OneItemModel extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $table = 'one_item_models';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'key_words',
        'zoom_in_btn_title',
        'prod_photo',
        'tag_id',
        'category_id',
        'prod_title',
        'prod_slug',
        'available',
        'customize',
        'prod_price',
        'bg_img_first_screen',
        'content'
    ];

    public $translatable = [
        'meta_title',
        'meta_description',
        'key_words',
        'zoom_in_btn_title',
        'prod_title',
        'prod_price',
        'content'
    ];

    public $mediaToUrl = [
        'content',
        'prod_photo',
        'bg_img_first_screen',
        'image'
    ];

    public function tag()
    {
        return $this->belongsTo(ProductTagModel::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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
