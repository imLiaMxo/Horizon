<?php

namespace App\Http\Requests\Admin;

use App\Rules\HexColor;
use App\Traits\NotifiesOnValidationFail;
use Illuminate\Foundation\Http\FormRequest;

class CompleteForm extends FormRequest
{
    use NotifiesOnValidationFail;

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
            'identifier' => 'required|integer',
            'action' => 'required|string',
            'reason' => 'string',
            'steamid' => 'string'
        ];
    }
}
