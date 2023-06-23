<?php

namespace App\Http\Requests\task;

use App\Http\Services\LocalizationService;
use App\Models\Task;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use function array_merge;
use function dump;

class StoreTaskRequest extends FormRequest
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
        $rules = LocalizationService::getModelRules(Task::$translatableData);
        return array_merge($rules , Task::rules());
    }
}
