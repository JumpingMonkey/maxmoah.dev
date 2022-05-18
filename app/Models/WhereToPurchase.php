<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class WhereToPurchase extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $table = 'where_to_purchases';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'key_words',
        'title',
        'description',
        'variants',
        'stores_list',
        'stores_title',
    ];

    public $translatable = [
        'title',
        'description',
        'variants',
        'stores_list',
        'meta_title',
        'meta_description',
        'key_words',
        'stores_title',
    ];

    public static function normalizeData($object){

        $contentItems = [];
        $buttonItems = [];
        $upcomingItems = [];

        if(isset($object['variants'])){
            foreach ($object['variants'] as $key => $item){

                if($item['layout'] == 'variant') {
                    foreach ($item['attributes']['button'] as $keyB => $itemB) {
                        $buttonItems = $itemB['attributes'];
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
