<?php

namespace App\Http\Requests\Admin;

use App\Models\Permission;
use App\Models\Role;
use App\Rules\HexColor;
use App\Traits\NotifiesOnValidationFail;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleForm extends FormRequest
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
        $unique = Rule::unique(Role::class, 'name');
        /*if ($this->routeIs('admin.roles.create')) {
            $unique->ignore(
                $this->route('role')->id
            );
        }*/

        return [
            'name' => ['required', 'string', 'max:50', $unique],
            'display_name' => ['required', 'string', 'max:50'],
            'color' => ['required', new HexColor()],
            'precedence' => ['required', 'integer'],
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => ['required', 'string', Rule::exists(Permission::class, 'name')],
        ];
    }
}
