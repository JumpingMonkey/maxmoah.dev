<?php
namespace App\Http\Middleware;

use Closure;
use App;
use Request;



class LocaleMiddleware
{
    public static $mainLanguage = 'en'; //основной язык, который не должен отображаться в URl

    public static $languages = ['en', 'ru', 'fr', 'it', 'de']; // Указываем, какие языки будем использовать в приложении.


    /*
     * Проверяет наличие корректной метки языка в текущем URL
     * Возвращает метку или значеие null, если нет метки
     */
    public static function getLocale()
    {
        $uri = Request::path(); //получаем URI


        $segmentsURI = explode('/',$uri); //делим на части по разделителю "/"

        //Проверяем метку языка  - есть ли она среди доступных языков
        if (!empty($segmentsURI[1]) && in_array($segmentsURI[1], self::$languages)) {
            if ($segmentsURI[1] != self::$mainLanguage) return $segmentsURI[1];

        }



        return null;
    }

    /*
    * Устанавливает язык приложения в зависимости от метки языка из URL
    */
    public function handle($request, Closure $next)
    {
        $locale = self::getLocale();

        if($locale) {

            App::setLocale($locale);
        }
        //если метки нет - устанавливаем основной язык $mainLanguage
        else {
            App::setLocale(self::$mainLanguage);
        }

        return $next($request); //пропускаем дальше - передаем в следующий посредник
    }

}
