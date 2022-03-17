<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Career extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vacancy_title' => 'required|string|max:100',
            'name' => 'string|max:500',
            'email' => 'required|email|max:250',
            'phone' => 'string|max:1000',
            'social_media' => 'string|max:1000',
            'files' => 'mimes:jpg,bmp,png',
        ];
    }
}
