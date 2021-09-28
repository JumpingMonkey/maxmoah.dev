<?php

namespace App\Traits;

trait TranslateAndConvertMediaUrl
{
    use HasMediaToUrl;

    public static function getNormalizedField(&$object, $fieldName, $attributeName, $fullCloneAttribute, $isObject){
        if (array_key_exists($fieldName, $object)){
            foreach ($object[$fieldName] as $item){
                if ($fullCloneAttribute){
                    $newData[] = $item["attributes"];
                    continue;
                }
                if ($isObject){
                    $newData[] = [$item["layout"] => $item["attributes"][$attributeName]];
                }else{
                    $newData[] = $item["attributes"][$attributeName];
                }
            }
            $object[$fieldName] = $newData;
        }




//        if ($object){
//            if (self::isAssoc($object)){
//                if (array_key_exists($fieldName, $object)){
//                    foreach ($object[$fieldName] as $item){
//                        if ($fullCloneAttribute){
//                            $newData[] = $item["attributes"];
//                            continue;
//                        }
//                        if ($isObject){
//                            $newData[] = [$item["layout"] => $item["attributes"][$attributeName]];
//                        }else{
//                            $newData[] = $item["attributes"][$attributeName];
//                        }
//                    }
//                    $object[$fieldName] = $newData;
//                }
//            }else{
//
//                dd($object);
//
//                foreach ($object as $objectItem){
//                    if (array_key_exists($fieldName, $objectItem)){
//                        foreach ($object[$fieldName] as $item){
//                            if ($fullCloneAttribute){
//                                $newData[] = $item["attributes"];
//                                continue;
//                            }
//                            if ($isObject){
//                                $newData[] = [$item["layout"] => $item["attributes"][$attributeName]];
//                            }else{
//                                $newData[] = $item["attributes"][$attributeName];
//                            }
//                        }
//                        $object[$fieldName] = $newData;
//                    }
//                }
//            }
//        }

    }


    /**
     * Get all attributes of your model
     *
     * @param array
     * @return mixed
     */

    public function getAllWithMediaUrlWithout($without = [])
    {
        $result = [];
        foreach ($this->attributes as $key => $attribute) {
            if (!in_array($key, $without)) {
                $this->getAttributeValueWithMediaUrlNew($result, $key);
            }
        }

        if ($this->relations) {
            foreach ($this->relations as $relKey => $relation) {
                if ($relKey != 'pivot') {
                    if (count($relation) > 0){
                        $result[$relKey] = array();
                        foreach ($relation as $relItemKey => $relItem) {
                            array_push($result[$relKey], $relItem->getAllWithMediaUrlWithout($without));
                        }
                    }
                }
            }
        }

        return $result;
    }


    public function getAttributeValueWithMediaUrlNew(&$result, $key)
    {

        // check, is HasTranslationsTrait
        if ($this->isHasTranslationsTrait()) {

//            if($this->isTranslatableAttribute($key) && $this->isMediaAttributeToUrl($key)){
//                return $result[$key] = $this->getOneMedia($this->getTranslation($key, $this->getLocale()));
//            }

            if (!$this->isTranslatableAttribute($key)) {

                // if is not translatable attribute
                // check, is "media attribute to url"

                if (!$this->isMediaAttributeToUrl($key) && !$this->isAttributeFromStrToJson($key)) {
                    // if is not "media attribute to url" return parent value
                    $attrValue = parent::getAttributeValue($key);

                    if ($attrValue && $attrValue != '[]') {
                        return $result[$key] = $attrValue;
                    }

                    return;

                }

                // check, is json, return array
                $attributeValueArray = $this->isJsonToArray($key);

                // check, array is empty and if is a "Nova Flexible field"
                if ($attributeValueArray !== [] && $this->isFlexibleField($attributeValueArray)) {
                    return $result[$key] = $this->getMediaUrlFlexible($attributeValueArray);
                }

                $mediaUrl = $this->getMediaUrl($key);

                if ($mediaUrl){
                    return $result[$key] = $mediaUrl;
                }

                return;
            }



            // if is "translatable attribute" get translation
            $translatedAttributeValue = $this->getTranslation($key, $this->getLocale());

            // if is not "media attribute to url" return attribute with translation
            if (!$this->isMediaAttributeToUrl($key)) {

                if ($translatedAttributeValue){
                    return $result[$key] = $translatedAttributeValue;
                }

                return;
            }

            if (!$translatedAttributeValue){
                return;
            }

            // if is media attribute to url check is json, return array
            $attributeValueArray = $this->isJsonToArray($key, $translatedAttributeValue);

            if ($attributeValueArray !== [] && $this->isFlexibleField($attributeValueArray)) {
                return $result[$key] = $this->getMediaUrlFlexible($attributeValueArray);
            }

            if ($attributeValueArray !== [] && !$this->isFlexibleField($attributeValueArray)) {
                return $result[$key] = $this->getMedia($attributeValueArray);
            }

            return $result[$key] = $this->getMediaUrl($key);
        }

        if (!$this->isMediaAttributeToUrl($key)) {
            // if is not "media attribute to url" return parent value
            return $result[$key] = parent::getAttributeValue($key);
        }
        // check, is json, return array

        $attributeValueArray = $this->isJsonToArray($key);
        // check, array is empty and if is a "Nova Flexible field"
        if ($attributeValueArray !== [] && $this->isFlexibleField($attributeValueArray)) {
            return $result[$key] = $this->getMediaUrlFlexible($attributeValueArray);
        }





        return $result[$key] = $this->getMediaUrl($key);

    }


    public function isAttributeFromStrToJson($key)
    {
        return in_array($key, $this->getAttributesFromStrTojson());
    }


    /**
     * @return array
     */
    public function getAttributesFromStrTojson()
    {
        return is_array($this->fromStrToJson)
            ? $this->fromStrToJson
            : [];
    }

    /**
     * @param string $key
     * @return array = [0 => url, 1 => url, 2 => url]
     * @return string = "url"
     */
    public function getMediaUrl($key)
    {

        $attrValue = parent::getAttributeValue($key);

        if ($attrValue && $attrValue != 'null') {
            return $this->getMedia(parent::getAttributeValue($key));
        }

        return "";

    }

    /**
     * Translate model by current Locale
     *
     * @param object $model
     * @param array $without = ['created_at','updated_at']
     * @return array
     */
    public function translateModel($without = [])
    {
        if (!$this->isHasTranslationsTrait()) {
            return $this->getAttributes();
        }
        foreach ($this->getAttributes() as $key => $field) {
            if (!$this->isTranslatableAttribute($key) && in_array($key, $without)) {
                $attributes[$key] = $field;
            }
        }
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::currentLocale());
        }
        return $attributes;
    }

    /**
     *
     * Translate model by current Locale without created_at, updated_at.
     *
     * @param  $model
     * @return array
     *
     */
    protected function translateModelWithoutTime($model)
    {
        return $this->translateModel($model, ['created_at', 'updated_at']);
    }

    /**
     *
     * Translate model by current Locale without id, created_at, updated_at.
     *
     * @param  $model
     * @return array
     *
     */
    protected function translateModelWithoutIdAndTime($model)
    {
        return $this->translateModel($model, ['created_at', 'updated_at', 'id']);
    }

}

