<?php

namespace App\Http\Requests\User\MiddleRunGoalController;

use Illuminate\Validation\Rule;
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
            'long_run_goal_id' => ['required', 'integer', 'exists:long_run_goals,id'],
            'title' => ['required', 'string', 'max:255'],
            'finish_on' => ['required', 'date'],
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            'long_run_goal_id',
            'title',
            'finish_on',
        ]);
    }
}
