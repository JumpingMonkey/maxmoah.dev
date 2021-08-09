<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

//    /**
//     * Get array id if error return '/storage/No_image_available.svg'.
//     *
//     *
//     * @param  $id = [0,1,2]
//     * @return array = [0 => url, 1 => url, 2 => url]
//     *
//     */
//    protected function getManyMedia($id)
//    {
//        $result = [];
//        if(!is_array($id) && substr($id, 0, 1) === '['){
//            $id = json_decode($id);
//        }
//        $media = DB::table('nova_media_library')->whereIn('id', $id)->pluck('name', 'id');
//        if ($media !== null) {
//            foreach ($media as $oneKey => $oneValue) {
//                $resultTemp[$oneKey] = '/storage/' . $oneValue;
//            }
//            foreach ($id as $oneKey => $oneValue) {
//                if (isset($media[$oneValue]) && $media[$oneValue] != null) {
//                    $result[$oneKey] = '/storage/' . $media[$oneValue];
//                } else {
//                    $result[$oneKey] = '/storage/No_image_available.svg';
//                }
//            }
//        }
//
//        return $result;
//    }
//    /**
//     * Get one id if error return '/storage/No_image_available.svg'.
//     *
//     * @param  $id
//     * @return string
//     *
//     */
//    public static function getOneMedia($id)
//    {
//        $media = DB::table('nova_media_library')->where('id', $id)->value('name');
//        if ($media === null) {
//            return '/storage/No_image_available.svg';
//        }
//        return '/storage/' . $media;
//    }
//
//    /**
//     * Get one id if error return '/storage/No_image_available.svg'.
//     *
//     * @param  $id
//     * @return string & array
//     *
//     */
//
//    public function getMedia($id)
//    {
//
//        if($id != null){
//            if(is_array($id)){
//                return $this->getManyMedia($id);
//            }elseif(!is_array($id) && substr($id, 0, 1) === '['){
//                return $this->getManyMedia($id);
//            }
//            return $this->getOneMedia($id);
//        }
//        return null;
//    }
//
//    /**
//     * переводит модель по текушей локали.
//     *
//     * @param  $model
//     * @return array
//     */
//    protected function translateModel($model)
//    {
//        foreach ($model->getAttributes() as $key => $field) {
//            if(!$model->isTranslatableAttribute($key)){
//                $attributes[$key] = $field;
//            }
//        }
//        foreach ($model->getTranslatableAttributes() as $field) {
//            $attributes[$field] = $model->getTranslation($field, App::currentLocale());
//        }
//        return $attributes;
//    }
//
//    /**
//     *
//     * переводит модель по текушей локали без created_at, updated_at.
//     *
//     * @param  $model
//     * @return array
//     *
//     */
//    protected function translateModelWithoutTime($model)
//    {
//        foreach ($model->getAttributes() as $key => $field) {
//            if(!$model->isTranslatableAttribute($key)  && $key !== 'created_at' && $key !== 'updated_at'){
//                $attributes[$key] = $field;
//            }
//        }
//        foreach ($model->getTranslatableAttributes() as $field) {
//            $attributes[$field] = $model->getTranslation($field, App::currentLocale());
//        }
//        return $attributes;
//    }
//
//    /**
//     *
//     * переводит модель по текушей локали без id, created_at, updated_at.
//     *
//     * @param  $model
//     * @return array
//     *
//     */
//    public static function translateModelWithoutIdAndTime($model)
//    {
//        foreach ($model->getAttributes() as $key => $field) {
//            if(!$model->isTranslatableAttribute($key) && $key !== 'id' && $key !== 'created_at' && $key !== 'updated_at'){
//                $attributes[$key] = $field;
//            }
//        }
//        foreach ($model->getTranslatableAttributes() as $field) {
//            $attributes[$field] = $model->getTranslation($field, App::currentLocale());
//        }
//        return $attributes;
//    }
//
//    protected function getLocal()
//    {
//        return App::currentLocale();
//    }
}


