<?php

namespace App\Http\Requests\User\LongRunGoalController;

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
            'purpose_id' => ['required', 'integer'],
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
            'purpose_id',
            'title',
            'finish_on',
        ]);
    }
}
