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
    ];

    public $translatable = [
        'title',
        'description',
        'popup_description',
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
