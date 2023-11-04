<?php

namespace App\Http\Requests\User\LongRunGoalController;

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
            'title' => ['required', 'string', 'max:255', 'unique:long_run_goals,title,'],
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
