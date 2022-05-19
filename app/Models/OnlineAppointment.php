<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class OnlineAppointment extends Model
{
    use HasFactory, HasMediaToUrl, HasTranslations;

    protected $table = "online_appointments";

    protected $fillable =[
        'title',
        'description',

        'language_variant',


        'button_title',

    ];

    public $translatable = [
        'title',
        'description',

        'language_variant',


        'button_title',

    ];

    public static function normalizeData($object){

        $contentItems = [];

        if(isset($object['language_variant'])){
            foreach ($object['language_variant'] as $key => $item){

                $contentItems[] = $item['attributes']['language'];
            }
            $object['language_variant'] = $contentItems;
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
