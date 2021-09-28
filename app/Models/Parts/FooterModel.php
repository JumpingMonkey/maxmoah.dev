<?php

namespace App\Models\Parts;

use App\Traits\HasMediaToUrl;
use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class FooterModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = "footer_models";

    protected $fillable = [
        'full_collection_btn_text',
        'soc_net_btn_text',
        'soc_networks',
        'large_footer',

    ];

    public $translatable = [
        'full_collection_btn_text',
        'soc_net_btn_text',
        'soc_networks',
        'large_footer',
    ];

    public static function normalizeData($object){

        self::getNormalizedField($object, 'soc_networks', "link", true, true);
        self::getNormalizedField($object, 'large_footer', "link", true, true);
        $fullData = [];
        foreach ($object['large_footer'] as $item){
            $itemData = [];
            $catItems = [];
            foreach ($item['block_items'] as $blockItem){
                $catItems[] = $blockItem['attributes'];
            }

            $itemData['block_items'] = $catItems;
            $itemData['block_title'] = $item['block_title'];

            $fullData[] = $itemData;
        }
        $object['large_footer'] = $fullData;
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
