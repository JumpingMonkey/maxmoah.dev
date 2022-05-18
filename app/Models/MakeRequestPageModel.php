<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class MakeRequestPageModel extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $table = 'make_request_pages';

    protected $fillable = [
        'title',
        'description',
        'name_field_title',
        'email_field_title',
        'phone_field_title',
        'message_field_title',
        'subject_variant',

        'button_title',

    ];

    public $translatable = [
        'title',
        'description',
        'name_field_title',
        'email_field_title',
        'phone_field_title',
        'message_field_title',
        'subject_variant',

        'button_title',

    ];

    public static function normalizeData($object){

        $contentItems = [];

        if(isset($object['subject_variant'])){
            foreach ($object['subject_variant'] as $key => $item){

                    $contentItems[] = $item['attributes']['subject'];
            }
            $object['subject_variant'] = $contentItems;
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
