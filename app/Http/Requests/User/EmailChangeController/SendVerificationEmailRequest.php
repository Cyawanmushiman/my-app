<?php

namespace App\Http\Requests\User\EmailChangeController;

use Illuminate\Foundation\Http\FormRequest;

class SendVerificationEmailRequest extends FormRequest
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
            'new_email' => ['required', 'email', 'unique:users,email'],
        ];
    }
    
    public function messages(): array
    {
        return [
            'new_email.required' => '新しいメールアドレスを入力してください。',
            'new_email.email' => '正しいメールアドレスを入力してください。',
            'new_email.unique' => 'このメールアドレスは既に使用されています。',
        ];
    }
}
