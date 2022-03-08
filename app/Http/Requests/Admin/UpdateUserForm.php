<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use App\Traits\NotifiesOnValidationFail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserForm extends FormRequest
{
    //use NotifiesOnValidationFail;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [

            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['required', Rule::exists(Role::class, 'id')],
        ];
    }
}
