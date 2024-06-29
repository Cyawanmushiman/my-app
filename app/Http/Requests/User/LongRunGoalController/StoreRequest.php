<?php

namespace App\Http\Requests\User\LongRunGoalController;

use App\Models\LongRunGoal;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
            'purpose_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'finish_on' => ['required', 'date'],
        ];
    }

    // 登録できるのは1つまで
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if (LongRunGoal::where('purpose_id', auth()->user()->purpose->id)->count() >= 1) {
                $validator->errors()->add('title', '登録できるのは1つまでです');
            }
        });
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
