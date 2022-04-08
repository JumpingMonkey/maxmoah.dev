<?php

namespace App\Models;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class NewsCategory extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $fillable = [
        'title',
    ];

    public $translatable = [
        'title',
    ];

    public $mediaToUrl = [

    ];

    public function oneNews(){
        return $this->belongsToMany(OneNews::class, 'news_category_news');
    }


    public static function normalizeData($object){

        if (array_key_exists('oneNews', $object)){
            foreach ($object['oneNews'] as $oneNews){
                $news[] = OneNews::normalizeData($oneNews);
            }
            $object['oneNews'] = $news;
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
