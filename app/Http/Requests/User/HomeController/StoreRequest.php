<?php

namespace App\Http\Requests\User\HomeController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'daily_run_goal_ids' => ['required', 'array'],
            // 'daily_run_goal_ids.*' => ['nullable', 'integer'],
            // 'diary' => ['required', 'string', 'max:3000'],
            // 'score' => ['required', 'integer'],
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            // 'diary',
            // 'score',
        ]);
    }
}
