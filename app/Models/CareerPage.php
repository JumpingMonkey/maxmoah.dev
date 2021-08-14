<?php

namespace App\Models;

use Anrail\NovaMediaLibraryTools\HasMediaToUrl;
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

        if(isset($object['variants'])){
            foreach ($object['variants'] as $key => $item){

                if($item['layout'] == 'variant') {
                    foreach ($item['attributes']['button'] as $keyB => $itemB) {
                        $buttonItems[$keyB . " : " . $itemB['layout']] = $itemB['attributes']['cta'];
                    }
                    $item['attributes']['button'] = $buttonItems;

                    if (isset($item['key'])) {
                        $contentItems[$key . " : " . $item['layout']] = $item['attributes'];
//                        dd($contentItems);
                    }
                }
                if($item['layout'] == 'upcoming_events') {
                    foreach ($item['attributes']['events'] as $keyE => $itemE) {
                        $upcomingItems[$keyE . " : " . $itemE['layout']] = $itemE['attributes'];
                    }
//                    dd($upcomingItems);
                    $item['attributes']['events'] = $upcomingItems;

                    if (isset($item['key'])) {
                        $contentItems[$key . " : " . $item['layout']] = $item['attributes'];
//                        dd($contentItems);
                    }
                }

            }
            $object['variants'] = $contentItems;
        }

        $storesItems = [];
        if(isset($object['stores_list'])){
            foreach ($object['stores_list'] as $key => $item){
                $storesItems[$key . " : " . $item['layout']] = $item['attributes'];
            }
            $object['stores_list'] = $storesItems;
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
