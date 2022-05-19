<?php

namespace App\Models;

use App\Traits\HasMediaToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class PrivateAppointment extends Model
{
    use HasFactory, HasMediaToUrl, HasTranslations;

    protected $table = "private_appointments";

    protected $fillable =[
        'title',
        'description',


        'button_title',


    ];

    public $translatable = [
        'title',
        'description',

        'button_title',


    ];

    public function getFullData(){
        try{

            $data = $this->getAllWithMediaUrlWithout(['id', 'created_at', 'updated_at']);
            return $data;

        } catch (\Exception $ex){
            throw new ModelNotFoundException();
        }

    }
}
