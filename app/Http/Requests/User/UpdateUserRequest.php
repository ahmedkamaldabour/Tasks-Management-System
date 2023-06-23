<?php

namespace App\Http\Requests\User;

use App\Http\Services\LocalizationService;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use function array_merge;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $translatable_rules = LocalizationService::getModelRules(User::$translatableData);
        return array_merge($translatable_rules, User::rules(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
                'password' => ['nullable', 'string', 'min:8' , 'regex:/^(?=.*[a-z])(?=.*\d).+$/'],
            ]
        );
    }
}
