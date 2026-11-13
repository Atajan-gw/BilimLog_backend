<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function groups(Request $request): JsonResponse
    {
        abort_unless($request->user()->role === 'teacher', 403);

        $groups = $request->user()->groups()
            ->with([
                'faculty:id,name',
                'students.user:id,name,surname,username,phone_number',
                'students.grades.subject:id,name,credits',
            ])
            ->orderBy('name')
            ->get();

        return response()->json(['data' => $groups]);
    }

    public function storeGrade(Request $request): JsonResponse
    {
        abort_unless($request->user()->role === 'teacher', 403);

        $data = $request->validate([
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
            'score' => ['required', 'numeric', 'min:0', 'max:100'],
            'semester' => ['required', 'string', 'max:20'],
        ]);

        $student = Student::query()->findOrFail($data['student_id']);
        $allowed = $request->user()->groups()->whereKey($student->group_id)->exists();
        abort_unless($allowed, 403, 'This student is not in your group.');

        $grade = Grade::query()->updateOrCreate(
            [
                'student_id' => $data['student_id'],
                'subject_id' => $data['subject_id'],
                'semester' => $data['semester'],
            ],
            ['score' => $data['score']],
        );

        return response()->json([
            'message' => 'Grade saved.',
            'data' => $grade->load('subject:id,name,credits'),
        ]);
    }
}
