<?php

namespace App\Http\Requests\User\MiddleRunGoalController;

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
        $longRunGoalId = $this->input('long_run_goal_id');
        $middleRunGoalId = $this->middle_run_goal;
    
        return [
            'long_run_goal_id' => ['required', 'exists:long_run_goals,id'],
            'title' => [
                'required',
                'string',
                'max:255',
                // ユニークバリデーションルールをカスタマイズ
                Rule::unique('middle_run_goals')
                    ->where('long_run_goal_id', $longRunGoalId)
                    ->ignore($middleRunGoalId) // 現在のmiddle_run_goalのIDを除外
            ],
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
        ]);
    }
}
