<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class CustomerServicePage extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $table = 'customer_service_pages';

    protected $fillable = [
        'sidebar_title',
        'services'
    ];

    public $translatable = [
        'sidebar_title',
        'services',
        'need_help_title',
        'email',
        'tel'
    ];

    public static function normalizeData($object){

        $contentItems = [];
        $questionItems = [];

        if(isset($object['services'])){
            foreach ($object['services'] as $key => $item){

                if($item['layout'] == 'faq' OR $item['layout'] == 'care_instructions') {
                    foreach ($item['attributes']['questions'] as $keyQ => $itemQ) {
                        $questionItems[$keyQ . " : " . $itemQ['layout']] = $itemQ['attributes'];
                    }

                    $item['attributes']['questions'] = $questionItems;
                    $contentItems[$key . " : " . $item['layout']] = $item['attributes'];
                }
                elseif ($item['layout'] == 'imprint' OR $item['layout'] == 'terms_and_conditions' OR $item['layout'] == 'privacy_policy'){

                    $longTextResult = [];
                    foreach ($item['attributes']['text_blocks'] as $longTextItem){
                        $longTextResult[] = $longTextItem['attributes'];
                    }
                    $item['attributes']['text_blocks'] = $longTextResult;
                    $contentItems[$key . " : " . $item['layout']] = $item['attributes'];
                }
                else {
                    $contentItems[$key . " : " . $item['layout']] = $item['attributes'];
                }

            }
            $object['services'] = $contentItems;
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
