<?php

namespace App\Models\Parts;

use App\Traits\HasMediaToUrl;
use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class HeaderModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = "header_models";

    protected $fillable = [
        'site_name',
        'menu_name',
        'make_appointment',
        'burger_close_btn_label',
        'header_navigation',
        'sub_header_navigation',

    ];

    public $translatable = [
        'site_name',
        'menu_name',
        'make_appointment',
        'burger_close_btn_label',
        'header_navigation',
        'sub_header_navigation',
    ];

    public static function normalizeData($object){

        self::getNormalizedField($object, 'header_navigation', "link", true, true);
        self::getNormalizedField($object, 'sub_header_navigation', "link", true, true);


//        $navToJson = json_decode($object['header_navigation']);
//        $subNavToJson = json_decode($object['sub_header_navigation']);
//        $object['header_navigation'] = $navToJson;
//        $object['sub_header_navigation'] = $subNavToJson;



        return $object;
    }

    public function getFullData()
    {
        try {

            $data = $this->getAllWithMediaUrlWithout(['id', 'created_at', 'updated_at']);
            return self::normalizeData($data);

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }
    }

}
