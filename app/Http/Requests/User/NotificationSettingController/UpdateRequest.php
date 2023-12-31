<?php

namespace App\Http\Requests\User\NotificationSettingController;

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
            'Monday-content' => [
                'nullable',
                'max:1000',
                Rule::requiredIf(function () {
                    return $this->input('Monday-action_time') !== null || $this->input('Monday-methods') !== null || $this->input('Monday-is_enable') !== null;
                })
            ],
            'Monday-action_time' => [
                'nullable',
                'date_format:H:i',
                Rule::requiredIf(function () {
                    return $this->input('Monday-content') !== null || $this->input('Monday-methods') !== null || $this->input('Monday-is_enable') !== null;
                })
            ],
            'Monday-methods' => [
                'nullable', 'array',
                Rule::requiredIf(function () {
                    return $this->input('Monday-content') !== null || $this->input('Monday-action_time') !== null || $this->input('Monday-is_enable') !== null;
                })
            ],
            'Monday-methods.*' => [
                'nullable', 'integer',
                Rule::requiredIf(function () {
                    return $this->input('Monday-content') !== null || $this->input('Monday-action_time') !== null || $this->input('Monday-is_enable') !== null;
                })
            ],
            'Monday-is_enable' => [
                'nullable',
            ],
            'Tuesday-content' => ['nullable', 'max:1000',
                Rule::requiredIf(function () {
                    return $this->input('Tuesday-action_time') !== null || $this->input('Tuesday-methods') !== null || $this->input('Tuesday-is_enable') !== null;
                })
            ],
            'Tuesday-action_time' => ['nullable', 'date_format:H:i',
                Rule::requiredIf(function () {
                    return $this->input('Tuesday-content') !== null || $this->input('Tuesday-methods') !== null || $this->input('Tuesday-is_enable') !== null;
                })
            ],
            'Tuesday-methods' => ['nullable', 'array',
                Rule::requiredIf(function () {
                    return $this->input('Tuesday-content') !== null || $this->input('Tuesday-action_time') !== null || $this->input('Tuesday-is_enable') !== null;
                })
            ],
            'Tuesday-methods.*' => ['nullable', 'integer',
                Rule::requiredIf(function () {
                    return $this->input('Tuesday-content') !== null || $this->input('Tuesday-action_time') !== null || $this->input('Tuesday-is_enable') !== null;
                })
            ],
            'Tuesday-is_enable' => ['nullable'],
            'Wednesday-content' => ['nullable', 'max:1000',
                Rule::requiredIf(function () {
                    return $this->input('Wednesday-action_time') !== null || $this->input('Wednesday-methods') !== null || $this->input('Wednesday-is_enable') !== null;
                })
            ],
            'Wednesday-action_time' => ['nullable', 'date_format:H:i',
                Rule::requiredIf(function () {
                    return $this->input('Wednesday-content') !== null || $this->input('Wednesday-methods') !== null || $this->input('Wednesday-is_enable') !== null;
                })
            ],
            'Wednesday-methods' => ['nullable', 'array',
                Rule::requiredIf(function () {
                    return $this->input('Wednesday-content') !== null || $this->input('Wednesday-action_time') !== null || $this->input('Wednesday-is_enable') !== null;
                })
            ],
            'Wednesday-methods.*' => ['nullable', 'integer',
                Rule::requiredIf(function () {
                    return $this->input('Wednesday-content') !== null || $this->input('Wednesday-action_time') !== null || $this->input('Wednesday-is_enable') !== null;
                })
            ],
            'Wednesday-is_enable' => ['nullable'],
            'Thursday-content' => ['nullable', 'max:1000',
                Rule::requiredIf(function () {
                    return $this->input('Thursday-action_time') !== null || $this->input('Thursday-methods') !== null || $this->input('Thursday-is_enable') !== null;
                })
            ],
            'Thursday-action_time' => ['nullable', 'date_format:H:i',
                Rule::requiredIf(function () {
                    return $this->input('Thursday-content') !== null || $this->input('Thursday-methods') !== null || $this->input('Thursday-is_enable') !== null;
                })
            ],
            'Thursday-methods' => ['nullable', 'array',
                Rule::requiredIf(function () {
                    return $this->input('Thursday-content') !== null || $this->input('Thursday-action_time') !== null || $this->input('Thursday-is_enable') !== null;
                })
            ],
            'Thursday-methods.*' => ['nullable', 'integer',
                Rule::requiredIf(function () {
                    return $this->input('Thursday-content') !== null || $this->input('Thursday-action_time') !== null || $this->input('Thursday-is_enable') !== null;
                })
            ],
            'Thursday-is_enable' => ['nullable'],
            'Friday-content' => ['nullable', 'max:1000',
                Rule::requiredIf(function () {
                    return $this->input('Friday-action_time') !== null || $this->input('Friday-methods') !== null || $this->input('Friday-is_enable') !== null;
                })
            ],
            'Friday-action_time' => ['nullable', 'date_format:H:i',
                Rule::requiredIf(function () {
                    return $this->input('Friday-content') !== null || $this->input('Friday-methods') !== null || $this->input('Friday-is_enable') !== null;
                })
            ],
            'Friday-methods' => ['nullable', 'array',
                Rule::requiredIf(function () {
                    return $this->input('Friday-content') !== null || $this->input('Friday-action_time') !== null || $this->input('Friday-is_enable') !== null;
                })
            ],
            'Friday-methods.*' => ['nullable', 'integer',
                Rule::requiredIf(function () {
                    return $this->input('Friday-content') !== null || $this->input('Friday-action_time') !== null || $this->input('Friday-is_enable') !== null;
                })
            ],
            'Friday-is_enable' => ['nullable'],
            'Saturday-content' => ['nullable', 'max:1000', 
                Rule::requiredIf(function () {
                    return $this->input('Saturday-action_time') !== null || $this->input('Saturday-methods') !== null || $this->input('Saturday-is_enable') !== null;
                })
            ],
            'Saturday-action_time' => ['nullable', 'date_format:H:i', 
                Rule::requiredIf(function () {
                    return $this->input('Saturday-content') !== null || $this->input('Saturday-methods') !== null || $this->input('Saturday-is_enable') !== null;
                })
            ],
            'Saturday-methods' => ['nullable',  'array', 
                Rule::requiredIf(function () {
                    return $this->input('Saturday-content') !== null || $this->input('Saturday-action_time') !== null || $this->input('Saturday-is_enable') !== null;
                })
            ],
            'Saturday-methods.*' => ['nullable',  'integer', 
                Rule::requiredIf(function () {
                    return $this->input('Saturday-content') !== null || $this->input('Saturday-action_time') !== null || $this->input('Saturday-is_enable') !== null;
                })
            ],
            'Saturday-is_enable' => ['nullable'],
            'Sunday-content' => ['nullable',  'max:1000', 
                Rule::requiredIf(function () {
                    return $this->input('Sunday-action_time') !== null || $this->input('Sunday-methods') !== null || $this->input('Sunday-is_enable') !== null;
                })
            ],
            'Sunday-action_time' => ['nullable',  'date_format:H:i', 
                Rule::requiredIf(function () {
                    return $this->input('Sunday-content') !== null || $this->input('Sunday-methods') !== null || $this->input('Sunday-is_enable') !== null;
                })
            ],
            'Sunday-methods' => ['nullable', 'array', 
                Rule::requiredIf(function () {
                    return $this->input('Sunday-content') !== null || $this->input('Sunday-action_time') !== null || $this->input('Sunday-is_enable') !== null;
                })
            ],
            'Sunday-methods.*' => ['nullable', 'integer', 
                Rule::requiredIf(function () {
                    return $this->input('Sunday-content') !== null || $this->input('Sunday-action_time') !== null || $this->input('Sunday-is_enable') !== null;
                })
            ],
            'Sunday-is_enable' => ['nullable'],
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            'Monday-content',
            'Monday-action_time',
            'Monday-methods',
            'Monday-is_enable',
            'Tuesday-content',
            'Tuesday-action_time',
            'Tuesday-methods',
            'Tuesday-is_enable',
            'Wednesday-content',
            'Wednesday-action_time',
            'Wednesday-methods',
            'Wednesday-is_enable',
            'Thursday-content',
            'Thursday-action_time',
            'Thursday-methods',
            'Thursday-is_enable',
            'Friday-content',
            'Friday-action_time',
            'Friday-methods',
            'Friday-is_enable',
            'Saturday-content',
            'Saturday-action_time',
            'Saturday-methods',
            'Saturday-is_enable',
            'Sunday-content',
            'Sunday-action_time',
            'Sunday-methods',
            'Sunday-is_enable',
        ]);
    }
}
