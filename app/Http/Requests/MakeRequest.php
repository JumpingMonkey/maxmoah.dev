<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeRequest extends FormRequest
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
            'subject' => 'required|string|max:250',
            'email' => 'required|email|max:200',
            'phone' => 'required|string|max:100',
            'message' => 'required|string|max:2000',
        ];
    }
}
