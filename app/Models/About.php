<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;
use function PHPUnit\Framework\isEmpty;

class About extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $table = "abouts";

    protected $fillable = [
        'content',
        'meta_title',
        'meta_description',
        'key_words',
        'filter',
        ];

    public $translatable = [
        'content',
        'meta_title',
        'meta_description',
        'key_words',
        'filter',
    ];

    public $mediaToUrl = [
        'content',
        'image',
        'src',
    ];


public static function normalizePhotoWithMetaData($obj, $getNameItem = false){
    $data = [];
    foreach ($obj as $item){
        if ($getNameItem){
            $data[$item['layout']] = $item['attributes'];
        } else {
            $data[] = $item['attributes'];
        }
    }
    return $data;
}

public static function normalizeTitleAndImageField($obj){
    $data = [];
    foreach ($obj as $item){
        $tmpData = [];
        $tmpData['title'] = $item['attributes']['title'];
        $tmpData['image'] = self::normalizePhotoWithMetaData($item['attributes']['image'], true)['image'];
        $data[] = $tmpData;
    }
    return $data;
}


    public static function normalizeData($object){

        $contentItems = [];
        if (isset($object['content'])){
            foreach ($object['content'] as $key => $item){

                if ($item['key']){
                    $contentItems[$key . " : " . $item['layout']] = $item['attributes'];
                }


            }
            $object['content'] = $contentItems;
        }

        foreach($object['content'] as $key => $item){
            foreach ($item as $inKey => $value) {
                if($inKey == 'title_and_image'){
                    $object['content'][$key][$inKey] = self::normalizeTitleAndImageField($object['content'][$key][$inKey]);
                }elseif(str_contains($inKey, 'image')){
                    $object['content'][$key][$inKey] = self::normalizePhotoWithMetaData($object['content'][$key][$inKey], true);
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
