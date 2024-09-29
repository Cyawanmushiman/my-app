<?php

namespace App\Http\Requests\User\TipController;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'content' => ['nullable', 'string', 'max:3000'],
        ];
    }
    
    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'content.string' => 'コツは文字列で入力してください',
            'content.max' => 'コツは3000文字以内で入力してください',
        ];
    }
    
    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'content' => 'コツ',
        ];
    }
    
    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            'content',
        ]);
    }
    
}
