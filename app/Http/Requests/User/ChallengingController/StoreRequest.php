<?php

namespace App\Http\Requests\User\ChallengingController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'opponent_name' => ['required', 'string', 'max:255'],
            'opponent_max_hit_point' => ['required', 'integer', 'min:1'],
            'user_max_hit_point' => ['required', 'integer', 'min:1'],
            'reward' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * @return array
     */
    public function ForChallenging(): array
    {
        return $this->only([
            'reward',
        ]);
    }

    /**
     * @return array
     */
    public function ForChallengingOpponentInfo(): array
    {
        return $this->only([
            'opponent_name',
            'opponent_max_hit_point',
        ]);
    }

    /**
     * @return array
     */
    public function ForUserChallengeAbility(): array
    {
        return $this->only([
            'user_max_hit_point',
        ]);
    }
}
