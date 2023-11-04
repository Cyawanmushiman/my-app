<?php

namespace App\Http\Requests\User\DailyRunGoalController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'short_run_goal_id' => ['required', 'exists:short_run_goals,id'],
            'title' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            'short_run_goal_id',
            'title',
        ]);
    }
}
