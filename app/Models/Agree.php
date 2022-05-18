<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class Agree extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $fillable = [
        'form_title',
        'email_field_title',
        'checkbox_text',
        'term_of_service_text',
        'term_of_service_link_text',
        'privacy_policy_text',
        'privacy_policy_link_text',
    ];

    protected $translatable = [
        'form_title',
        'email_field_title',
        'checkbox_text',
        'term_of_service_text',
        'privacy_policy_text',
    ];

    public static function normalizeData($object){
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
