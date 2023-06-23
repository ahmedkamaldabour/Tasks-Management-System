<?php

namespace App\Http\Requests\phase;

use App\Http\Services\LocalizationService;
use App\Models\Phase;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PhaseRequest extends FormRequest
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
        return LocalizationService::getModelRules(Phase::$translatableData);
    }
}
