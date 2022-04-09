<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class OneNews extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $casts = [
        'publication_date' => 'date',
    ];

    protected $fillable = [
        'meta_title',
        'meta_description',
        'key_words',
        'title_on_the_news_page',
        'description_on_the_news_page',
        'publication_date',
        'news_title',
        'blocks',
        'slug',
        'news_category_id',
    ];

    public $translatable = [
        'meta_title',
        'meta_description',
        'key_words',
        'title_on_the_news_page',
        'description_on_the_news_page',
        'news_title',
        'blocks',

    ];

    public $mediaToUrl = [
        'blocks',
        'src',
    ];

    public function newsCategory(){
        return $this->belongsToMany(NewsCategory::class, 'news_category_news');
    }

    public function newsOneCategory(){
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }


    public static function normalizePhotoWithMetaData($obj){
        $data = [];
        foreach ($obj as $item){
            $data = $item['attributes'];
        }
        return $data;
    }

    public static function normalizeTitleAndImageField($obj){
        $data = [];
        foreach ($obj as $item){
            $tmpData = [];
            $tmpData['title'] = $item['attributes']['title'];
            $tmpData['image'] = self::normalizePhotoWithMetaData($item['attributes']['image']);
            $data[] = $tmpData;
        }
        return $data;
    }


    public static function normalizeData($object){

        self::getNormalizedField($object, 'blocks', 'text', true, true);


        if (isset($object['blocks'])){
            foreach ($object['blocks'] as $key => $item){

                if(array_key_exists('background_color', $item) and !empty($item['background_color'])){
                    $object['blocks'][$key]['background_color'] = $object['blocks'][$key]['background_color'][0]['attributes']['background_color'];
                }
                if(array_key_exists('text_color', $item) and !empty($item['text_color'])){
                    $object['blocks'][$key]['text_color'] =  $object['blocks'][$key]['text_color'][0]['attributes']['text_color'];
                }


                if (array_key_exists('bg_image_video', $item)){
                    $contentItems = [];
                    foreach ($item['bg_image_video'] as $imgKey => $imgItem) {
                        $contentItems[$imgItem['layout']]  = $imgItem['attributes'];
                    }
                    $object['blocks'][$key]['bg_image_video'] = $contentItems;
                }
            }
        }

        return $object;
    }

    public function getFullData(){
        try{

            $data = $this->getAllWithMediaUrlWithout(['id', 'created_at', 'updated_at']);

            return self::normalizeData($data);

        } catch (\Exception $ex){
            throw new ModelNotFoundException();
        }

    }
}
