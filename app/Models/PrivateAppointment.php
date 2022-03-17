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
        'name_field_title',
        'email_field_title',
        'country_field_title',
        'phone_field_title',
        'time_field_title',
        'privacy_policy_text',
        'privacy_policy_link_text',
        'button_title',
        'close_button_title',
        'calendar_title',
    ];

    public $translatable = [
        'title',
        'description',
        'name_field_title',
        'email_field_title',
        'country_field_title',
        'phone_field_title',
        'time_field_title',
        'privacy_policy_text',
        'privacy_policy_link_text',
        'button_title',
        'close_button_title',
        'calendar_title',
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
