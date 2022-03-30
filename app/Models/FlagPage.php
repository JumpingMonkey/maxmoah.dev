<?php

namespace App\Models;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class FlagPage extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $fillable = [
        'title',
        'description',
        'popup_description',
        'background_photo_video',
        'filter',
    ];

    public $translatable = [
        'title',
        'description',
        'popup_description',
    ];

    public $mediaToUrl = [
        'background_photo_video',
        'item',
    ];

    public static function normalizeData($object){
        self::getNormalizedField($object, 'background_photo_video', 'item', true, true);
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
