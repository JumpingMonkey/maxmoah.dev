<?php

namespace App\Models;

use Anrail\NovaMediaLibraryTools\HasMediaToUrl;
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
        'seo_title',
        'meta_description',
        'key_words'
        ];

    public $translatable = [
        'content',
        'seo_title',
        'meta_description',
        'key_words'
    ];

    public $mediaToUrl = [
        'content',
        'image',
    ];

//   public static function norm($object)
//   {
//       foreach ($object as $item) {
//           if (is_array($item) or is_object($item)){
//                self::norm($item);
//           } else {
//
//           }
//       }
//
//        }


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
