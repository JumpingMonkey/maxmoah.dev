<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class OneItemModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

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
        'bg_video_first_screen',
        'content',
        'color',
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
        'bg_video_first_screen',
        'image',
        'video',
        'color'
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

        self::getNormalizedField($object, 'prod_photo', 'image', 'true', 'true');
        self::getNormalizedField($object, 'bg_img_first_screen', 'image', 'true', 'true');
        self::getNormalizedField($object, 'bg_video_first_screen', 'video', 'true', 'true');
        self::getNormalizedField($object, 'color', 'color_one', 'true', 'true');

        if(array_key_exists('content', $object)){
            $content = [];
            foreach ($object['content'] as $key => $item){
                $content[$key . '_' . $item['layout']] = $item['attributes'];
            }
            $object['content'] = $content;

            $imgFields = ['img', 'lt_img', 'rt_img', 'img_1', 'img_2', 'loop'];


            foreach ($object['content'] as $key => $item){
                foreach ($item as $keyIn => $value){

                    if(in_array($keyIn, $imgFields)){
                        if($keyIn == 'loop'){
                            $content = [];
                            foreach ($value as $itemIn){
                                $content[] = $itemIn['attributes'];
                            }
                            $object['content'][$key][$keyIn] = $content;
                        } else {
                            $object['content'][$key][$keyIn] = self::normalizePhotoWithMetaData($object['content'][$key][$keyIn]);
                        }
                    }

                    if($keyIn == 'prod'){
                        $tmpContent = [];
                        foreach ($value as $itemIn){
                            $tmpContent[] = $itemIn['attributes']['prod'];
                        }
                        $data = OneItemModel::query()->select('prod_slug', 'prod_title', 'prod_photo', 'prod_price', 'tag_id')
                            ->whereIn('id', $tmpContent)
                            ->get();


                        foreach ($data as $oneProduct) {
                            $tagName = OneItemModel::getFullData($oneProduct);
                            if (isset($tagName['tag_id'])){
                                $tagName['prod_tag'] = $oneProduct->tag->tag_title;
                                unset($tagName['tag_id']);
                            }
                            $prodContent[] = $tagName;
                        }

                        $object['content'][$key] = $prodContent;
                    }
                    if($keyIn == 'product_1' OR $keyIn == 'product_2'){
                        $tmpContent = [];

                        $data = OneItemModel::query()->select('prod_slug', 'prod_title', 'prod_photo', 'prod_price', 'tag_id')
                            ->where('id', $value)
                            ->get();

                        foreach ($data as $oneProduct) {
                            $tagName = OneItemModel::getFullData($oneProduct);
                            if (isset($tagName['tag_id'])){
                                $tagName['prod_tag'] = $oneProduct->tag->tag_title;
                                unset($tagName['tag_id']);
                            }
                            $prodContent[] = $tagName;
                        }

                        $object['content'][$key] = $prodContent;
                    }
                }
            }
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
