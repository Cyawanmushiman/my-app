<?php

namespace App\Http\Requests\User\DailyRunGoalController;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255', Rule::unique('daily_run_goals')->ignore($this->daily_run_goal)],
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            'title',
        ]);
    }
}
