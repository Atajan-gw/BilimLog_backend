<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
{
    public function authorize(): bool { return (bool) $this->user()?->isAdmin(); }

    public function rules(): array {
        return [
            'name' => ['required', 'string', 'max:100'],
            'faculty_id' => ['required', 'exists:faculties,id'],
            'course_number' => ['required', 'integer', 'between:1,8'],
        ];
    }
}
