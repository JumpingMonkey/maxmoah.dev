<?php

namespace App\Models;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class CareerPopupPage extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'career_popup_pages';

    protected $fillable = [
        'title',
        'description',
        'vacancy_title',
        'name_label',
        'email_label',
        'phone_label',
        'social_media_label',
        'upload_label',
        'agree_text',
        'privacy_policy_link_text',
        'privacy_policy_link',
        'button_title',
    ];

    public $translatable = [
        'title',
        'description',
        'vacancy_title',
        'name_label',
        'email_label',
        'phone_label',
        'social_media_label',
        'upload_label',
        'agree_text',
        'privacy_policy_link_text',
        'privacy_policy_link',
        'button_title',
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