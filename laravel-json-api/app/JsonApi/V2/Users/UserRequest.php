<?php

namespace App\JsonApi\V2\Users;

use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class UserRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
         /** @var \App\Models\User|null $model */
         if ($model = $this->model()) {
            return [
                'name'          => ['sometimes', 'string'],
                'email'         => ['sometimes', 'email', Rule::unique('users')->ignore($model->id)],
                'password'      => ['sometimes', 'confirmed', 'string', 'min:8'],
            ];
        }

        return [
            'name'          => ['required', 'string'],
            'email'         => ['required', 'email', Rule::unique('users')],
            'password'      => ['required', 'confirmed', 'string', 'min:8'],
        ];
    }

}
