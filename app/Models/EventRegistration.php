<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class EventRegistration extends Model
{
    use HasFactory, HasMediaToUrl, HasTranslations;

    protected $table = "event_registrations";

    protected $fillable =[
        'title',
        'description',

        'button_title',

    ];

    public $translatable = [
        'title',
        'description',

        'button_title',

    ];

    public static function normalizeData($object){

//        $contentItems = [];
//
//        if(isset($object['event_variant'])){
//            foreach ($object['event_variant'] as $key => $item){
//
//                $contentItems[] = $item['attributes']['event'];
//            }
//            $object['event_variant'] = $contentItems;
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
