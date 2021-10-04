<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class FiltersModel extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $table = 'filters_models';

    protected $fillable = [
        'prod_category_filter_title',
        'sort_title',
        'price_highest_label',
        'price_lowest_label',
        'newest_label',
    ];

    protected $translatable = [
        'prod_category_filter_title',
        'sort_title',
        'price_highest_label',
        'price_lowest_label',
        'newest_label',
    ];

    public static function normalizeData($object){

//        $contentItems = [];
//        if (isset($object['subject_field'])){
//            foreach ($object['subject_field'] as $key => $item){
//
//                if ($item['key']){
//                    $contentItems[$key . " " . 'subj_title'] = $item['attributes']['subj_title'];
//                }
//
//
//            }
//            $object['subject_field'] = $contentItems;
//        }

        return $object;
    }



    public function getFullData(){
        try{

            $category = Category::query()->select('category_title', 'category_slug')->get();
            $cat = [];
            foreach ($category as $item){
               $cat[] = $item->getAllWithMediaUrlWithout(['id', 'created_at', 'updated_at']);
            }

            $data = $this->getAllWithMediaUrlWithout(['id', 'created_at', 'updated_at']);
            $data['category_filters'] = empty($cat) ? 'category not exist': $cat;
            return self::normalizeData($data);

        } catch (\Exception $ex){
            throw new ModelNotFoundException();
        }

    }
}
