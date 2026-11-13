<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->canSetAvatar() ?? false;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->user()?->id;

        return [
            'name' => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:100'],
            'phone_number' => ['required', 'string', 'max:30', Rule::unique('users', 'phone_number')->ignore($userId)],
            'username' => ['required', 'alpha_dash', 'min:3', 'max:50', Rule::unique('users', 'username')->ignore($userId)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }
}
