<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{  
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'description' => 'required',
            'brands_id' => 'required|exists:brands,id',
            'categories_id' => 'required|exists:categories,id',
            'image_url' => 'required',
            'products_url' => 'nullabel',
            'price' => 'nullable',
        ];
    }

     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
        
        ];
    }
}
