<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
