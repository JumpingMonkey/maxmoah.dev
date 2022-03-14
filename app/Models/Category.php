<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $fillable = [
        'meta_title',
        'meta_description',
        'key_words',
        'category_title',
        'category_slug',
        'content',
        'tag_id',
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
        'image',
    ];

    public function products(){

        return $this->hasMany(OneItemModel::class);

    }

    public static function normalizeData($object){
        if(array_key_exists('content', $object)){
            $data = [];
            foreach ($object['content'] as $item){
                $data[$item['layout']] = $item['attributes'];

                if(array_key_exists('image', $data[$item['layout']])){
                    $data[$item['layout']]['image'] = self::normalizePhotoWithMetaData($data[$item['layout']]['image']);
                }

                if($item['layout'] == '6_products'){

                    $products = [];
                    foreach ($data[$item['layout']]['product'] as $prod){
                        $products[] = $prod['attributes'];
                    }
                    $data[$item['layout']]['product'] = $products;

                    $products = [];
                    foreach ($data[$item['layout']]['product'] as $itemIn){
                        $itemIn['image'] = self::normalizePhotoWithMetaData($itemIn['image']);
                        $products[] = $itemIn;
                    }
                    $data[$item['layout']]['product'] = $products;
                }

                if($item['layout'] == '7_prod_from_category') {
                    self::getNormalizedField($data['7_prod_from_category'], 'one_prod', 'product', 'true', 'true');

                    foreach ($data['7_prod_from_category']['one_prod'] as $value){
                        $tmpData[] = $value['product'];
                    }
                    $data['7_prod_from_category'] = $tmpData;


                    $productsData = OneItemModel::query()
                        ->select('prod_slug', 'prod_title', 'prod_photo', 'prod_price', 'tag_id', 'customize')
                        ->whereIn('id', $data['7_prod_from_category'])
                        ->get();

//                    $fullData = OneItemModel::getFullData($productsData);


                    $productContent = [];
                    foreach ($productsData as $oneProduct) {

                        $fullDataWithTagName = OneItemModel::getFullData($oneProduct);

                        if (isset($fullDataWithTagName['tag_id'])){
                            $fullDataWithTagName['prod_tag'] = $oneProduct->tag->tag_title;
                            unset($fullDataWithTagName['tag_id']);
                        }

                        $imgData = [];
                        foreach ($fullDataWithTagName['prod_photo'] as $oneImg){
                            $imgData[] = $oneImg['attributes'];
                        }

                        $fullDataWithTagName['prod_photo'] = $imgData;
                        $productContent[] = $fullDataWithTagName;
                    }
                    $data['7_prod_from_category'] = $productContent;
                }
            }
            $object['content'] = $data;
        }

        if (array_key_exists('tag_id', $object)) {
            $tag = ProductTagModel::query()
                ->where('id', $object['tag_id'])
                ->firstOrFail('tag_title');
            $object['tag'] = ProductTagModel::getFullData($tag);
        }
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
