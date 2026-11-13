<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:100'],
            'phone_number' => ['required', 'string', 'max:30', 'unique:users,phone_number'],
            'username' => ['required', 'alpha_dash', 'max:50', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'faculty_id' => ['required', 'exists:faculties,id'],
            'group_id' => ['required', 'exists:groups,id'],
            'specialty' => ['required', 'string', 'max:255'],
            'course_year' => ['required', 'integer', 'between:1,8'],
            'student_id_card_number' => ['required', 'string', 'max:50', 'unique:students,student_id_card_number'],
        ];
    }
}
