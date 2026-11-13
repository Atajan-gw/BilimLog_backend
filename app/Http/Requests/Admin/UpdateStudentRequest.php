<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->isAdmin();
    }

    public function rules(): array
    {
        $student = $this->route('student');

        return [
            'name' => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:100'],
            'phone_number' => [
                'required',
                'string',
                'max:30',
                Rule::unique('users', 'phone_number')->ignore($student?->user_id),
            ],
            'username' => [
                'required',
                'alpha_dash',
                'max:50',
                Rule::unique('users', 'username')->ignore($student?->user_id),
            ],
            'password' => ['nullable', 'string', 'min:8'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'faculty_id' => ['required', 'exists:faculties,id'],
            'group_id' => ['required', 'exists:groups,id'],
            'specialty' => ['required', 'string', 'max:255'],
            'course_year' => ['required', 'integer', 'between:1,8'],
            'student_id_card_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'student_id_card_number')->ignore($student?->id),
            ],
        ];
    }
}
