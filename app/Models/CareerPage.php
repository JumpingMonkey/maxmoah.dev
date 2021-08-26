<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class CareerPage extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $table = 'career_pages';

    protected $fillable = [
        'title',
        'description',
        'vacancies',
        'bottom_description',
        'first_bottom_field',
        'second_bottom_field',
        'third_bottom_field',
        'meta_title',
        'meta_description',
        'key_words'
    ];

    public $translatable = [
        'title',
        'description',
        'vacancies',
        'bottom_description',
        'first_bottom_field',
        'second_bottom_field',
        'third_bottom_field',
        'meta_title',
        'meta_description',
        'key_words'
    ];

    public static function normalizeData($object){

        $contentItems = [];
        $buttonItems = [];
        $upcomingItems = [];

        if(isset($object['vacancies'])){
            foreach ($object['vacancies'] as $key => $item){

                    if (isset($item['key'])) {
                        $contentItems[] = $item['attributes'];
//                        dd($contentItems);
                    }
            }
            $object['vacancies'] = $contentItems;
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
