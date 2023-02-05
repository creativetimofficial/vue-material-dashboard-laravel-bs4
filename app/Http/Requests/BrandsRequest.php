<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required', 'min:3'
            ],
            'description' => [
                'nullable'
            ],
            'url_image_path' => [
                'required'
            ]
        ];
    }
}
