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

        self::getNormalizedField($object, 'blocks', 'text', true, true, true);

        $contentItems = [];
        if (isset($object['blocks'])){
            foreach ($object['blocks'] as $key => $item){
                if (array_key_exists('image_or_video', $item)){
                    foreach ($item['image_or_video'] as $imgKey => $imgItem) {
                        $contentItems[$imgItem['layout']]  = $imgItem['attributes'];
                    }
                    $object['blocks'][$key]['image_or_video'] = $contentItems;
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
