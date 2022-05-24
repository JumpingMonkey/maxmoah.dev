<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class CareerPage extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'career_pages';

    protected $fillable = [
        'title',
        'description',
        'vacancies',
        'bottom_description',
        'button_in_the_bottom_text',
        'popup_button_text',
        'meta_title',
        'meta_description',
        'key_words'
    ];

    public $translatable = [
        'title',
        'description',
        'vacancies',
        'bottom_description',
        'button_in_the_bottom_text',
        'popup_button_text',
        'meta_title',
        'meta_description',
        'key_words'
    ];

    public static function normalizeData($object){

        self::getNormalizedField($object, 'vacancies', 'properties', true, true);

        if(isset($object['vacancies'])){

            foreach ($object['vacancies'] as $key => $item){
                if (isset($item['properties'])){
                    $properties = [];
                    foreach ($item['properties'] as $propItem){
                        $properties[] = $propItem['attributes'];
                    }
                    $object['vacancies'][$key]['properties'] = $properties;
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
