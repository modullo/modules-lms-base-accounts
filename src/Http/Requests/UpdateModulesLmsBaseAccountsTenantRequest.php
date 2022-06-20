<?php

namespace Modullo\ModulesLmsBaseAccounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateModulesLmsBaseAccountsTenantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
//            'email' => ['required','email'],
            'phone_number' => ['required'],
            'password' => ['nullable', 'string', 'min:6'],
            'gender' => ['nullable','string','in:male,female'],
            'image' => ['nullable','string'],
            'location' => ['nullable','string'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
