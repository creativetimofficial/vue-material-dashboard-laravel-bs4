<?php

namespace App\Http\Requests;

use App\Clients;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClientsRequest extends FormRequest
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
            'email' => [
                'required', 'email', Rule::unique((new Clients)->getTable())->ignore($this->route()->clients->id ?? null)
            ],
            'password' => [
                $this->route()->clients ? 'nullable' : 'required', 'confirmed', 'min:6'
            ]
        ];
    }
}
