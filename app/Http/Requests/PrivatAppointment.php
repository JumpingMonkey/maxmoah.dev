<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrivatAppointment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|max:500',
            'email' => 'required|email|max:250',
            'country_city' => 'required|string|max:250',
            'phone' => 'required|string|max:1000',
            'time' => 'string|max:100',
        ];
    }
}
