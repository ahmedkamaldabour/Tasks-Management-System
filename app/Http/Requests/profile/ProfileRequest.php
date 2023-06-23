<?php

namespace App\Http\Requests\profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*\d).+$/',
            'password_confirmation' => 'required|min:8',
        ];
    }
}
