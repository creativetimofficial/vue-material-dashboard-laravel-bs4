<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentsRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'clients_id' => [
                'required'
            ],
            'products_id' => [
                'required'
            ],
            'title' => [
                'required', 'min:3'
            ],
            'description' => [
                'required'
            ],
            'rate' => [
                'required'
            ]
        ];
    }
}
