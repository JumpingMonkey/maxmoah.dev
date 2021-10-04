<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class ProductAvailablePageModel extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $table = 'product_available_page_models';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'key_words',
        'title',
        'description',
        'message_if_no_items',
        'form_title',
        'email_field_title',
        'privacy_policy_text',
        'privacy_policy_link_text',
        'filter',
    ];

    public $translatable = [
        'meta_title',
        'meta_description',
        'key_words',
        'title',
        'description',
        'message_if_no_items',
        'form_title',
        'email_field_title',
        'privacy_policy_text',
        'privacy_policy_link_text',
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

            $data = $this->getAllWithMediaUrlWithout(['id', 'created_at', 'updated_at']);
            return self::normalizeData($data);

        } catch (\Exception $ex){
            throw new ModelNotFoundException();
        }

    }
}
