<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnlineAppointment extends FormRequest
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
            'language' => 'required|string|max:250',
            'email' => 'required|email|max:200',
            'phone' => 'string|max:100',
            'date' => 'string|max:100',
            'time' => 'string|max:100',
        ];
    }
}
