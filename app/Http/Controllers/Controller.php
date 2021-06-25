<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;



/**
 * @SWG\Swagger(
 *   schemes={"https"},
 *   produces={"application/json"},
 *   consumes={"application/json"},
 *   @OA\Info(
 *     description="MaxMoah API
<h4><strong>После загрузки проекта:</strong></h4>
<p>Настроить .env</p>
<p>composer update</p>
<p>php artisan key:generate</p>
<p>php artisan migrate</p>
<p>php artisan storage:link</p>
<h4><strong>версия PHP: 7.4.16</strong></h4>
<h4><strong>версия MySQL: 8.0.23-0ubuntu0.20.04.1</strong></h4>
<h4><strong>Использованные пакеты:</strong></h4>
<p>classic-o/nova-media-library: ^1.0,</p>
<p>darkaonline/l5-swagger: ^8.0,</p>
<p>digitalcloud/multilingual-nova: ^2.0,</p>
<p>drobee/nova-sluggable: ^1.2,</p>
<p>fideloper/proxy: ^4.4,</p>
<p>fruitcake/laravel-cors: ^2.0,</p>
<p>guzzlehttp/guzzle: ^7.0.1,</p>
<p>laravel/framework: ^8.12,</p>
<p>laravel/nova: 3.19.1,</p>
<p>laravel/tinker: ^2.5,</p>
<p>optimistdigital/nova-sortable: ^2.1,</p>
<p>whitecube/nova-flexible-content: ^0.2.7</p>
",
 *     version="1.0.0",
 *     title="Swagger MaxMoah",
 *     termsOfService="http://swagger.io/terms/",
 *     @OA\Contact(
 *         email="@"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 *   )
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get array id if error return '/storage/No_image_available.svg'.
     *
     *
     * @param  $id = [0,1,2]
     * @return array = [0 => url, 1 => url, 2 => url]
     *
     */
    protected function getManyMedia($id)
    {
        $result = [];
        if(!is_array($id) && substr($id, 0, 1) === '['){
            $id = json_decode($id);
        }
        $media = DB::table('nova_media_library')->whereIn('id', $id)->pluck('name', 'id');
        if ($media !== null) {
            foreach ($media as $oneKey => $oneValue) {
                $resultTemp[$oneKey] = '/storage/' . $oneValue;
            }
            foreach ($id as $oneKey => $oneValue) {
                if (isset($media[$oneValue]) && $media[$oneValue] != null) {
                    $result[$oneKey] = '/storage/' . $media[$oneValue];
                } else {
                    $result[$oneKey] = '/storage/No_image_available.svg';
                }
            }
        }

        return $result;
    }
    /**
     * Get one id if error return '/storage/No_image_available.svg'.
     *
     * @param  $id
     * @return string
     *
     */
    public static function getOneMedia($id)
    {
        $media = DB::table('nova_media_library')->where('id', $id)->value('name');
        if ($media === null) {
            return '/storage/No_image_available.svg';
        }
        return '/storage/' . $media;
    }

    /**
     * Get one id if error return '/storage/No_image_available.svg'.
     *
     * @param  $id
     * @return string & array
     *
     */

    public function getMedia($id)
    {

        if($id != null){
            if(is_array($id)){
                return $this->getManyMedia($id);
            }elseif(!is_array($id) && substr($id, 0, 1) === '['){
                return $this->getManyMedia($id);
            }
            return $this->getOneMedia($id);
        }
        return null;
    }

    /**
     * переводит модель по текушей локали.
     *
     * @param  $model
     * @return array
     */
    protected function translateModel($model)
    {
        foreach ($model->getAttributes() as $key => $field) {
            if(!$model->isTranslatableAttribute($key)){
                $attributes[$key] = $field;
            }
        }
        foreach ($model->getTranslatableAttributes() as $field) {
            $attributes[$field] = $model->getTranslation($field, App::currentLocale());
        }
        return $attributes;
    }

    /**
     *
     * переводит модель по текушей локали без created_at, updated_at.
     *
     * @param  $model
     * @return array
     *
     */
    protected function translateModelWithoutTime($model)
    {
        foreach ($model->getAttributes() as $key => $field) {
            if(!$model->isTranslatableAttribute($key)  && $key !== 'created_at' && $key !== 'updated_at'){
                $attributes[$key] = $field;
            }
        }
        foreach ($model->getTranslatableAttributes() as $field) {
            $attributes[$field] = $model->getTranslation($field, App::currentLocale());
        }
        return $attributes;
    }

    /**
     *
     * переводит модель по текушей локали без id, created_at, updated_at.
     *
     * @param  $model
     * @return array
     *
     */
    public static function translateModelWithoutIdAndTime($model)
    {
        foreach ($model->getAttributes() as $key => $field) {
            if(!$model->isTranslatableAttribute($key) && $key !== 'id' && $key !== 'created_at' && $key !== 'updated_at'){
                $attributes[$key] = $field;
            }
        }
        foreach ($model->getTranslatableAttributes() as $field) {
            $attributes[$field] = $model->getTranslation($field, App::currentLocale());
        }
        return $attributes;
    }

    protected function getLocal()
    {
        return App::currentLocale();
    }
}


