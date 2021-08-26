<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class Contact extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $table = "contacts";

    protected $fillable = [
        'subject_field',
        'button_title'
    ];

    public $translatable = [
        'subject_field',
        'button_title'
    ];

    public static function normalizeData($object){

        $contentItems = [];
        if (isset($object['subject_field'])){
            foreach ($object['subject_field'] as $key => $item){

                if ($item['key']){
                    $contentItems[$key . " " . 'subj_title'] = $item['attributes']['subj_title'];
                }


            }
            $object['subject_field'] = $contentItems;
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
