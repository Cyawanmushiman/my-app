<?php

namespace App\Http\Requests\User\ChallengingLogController;

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
            'daily_run_goal_ids' => ['nullable', 'array'],
            'daily_run_goal_ids.*' => ['nullable', 'integer'],
            'diary' => ['nullable', 'string', 'max:3000'],
        ];
    }
    
    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            'daily_run_goal_ids',
            'diary',
        ]);
    }
}
