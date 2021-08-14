<?php

namespace App\Models;

use Anrail\NovaMediaLibraryTools\HasMediaToUrl;
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

                if($item['layout'] != 'faq') {
                    $contentItems[$key . " : " . $item['layout']] = $item['attributes'];
                }

                if($item['layout'] == 'faq') {
                    foreach ($item['attributes']['questions'] as $keyQ => $itemQ) {
                        $questionItems[$keyQ . " : " . $itemQ['layout']] = $itemQ['attributes'];
                    }

                    $item['attributes']['questions'] = $questionItems;
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
