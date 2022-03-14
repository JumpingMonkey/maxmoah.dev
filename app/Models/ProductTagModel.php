<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class ProductTagModel extends Model
{
    use HasFactory, HasTranslations, HasMediaToUrl;

    protected $table = 'tags';

    protected $fillable = [
        'tag_title'
    ];

    protected $translatable = [
        'tag_title'
    ];

    public function products()
    {
        return $this->hasMany(OneItemModel::class);
    }

    public static function normalizeData($object){
        return $object;
    }

    public static function getFullData($object) {
        try{
            $data = $object->getAllWithMediaUrlWithout(['id', 'created_at', 'updated_at']);
            return self::normalizeData($data);

        } catch (\Exception $ex){
            throw new ModelNotFoundException();
        }
    }
}
