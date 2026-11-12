<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStudentRequest;
use App\Models\Student;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Group;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = \App\Models\Student::with([
            'user',
            'faculty',
            'group'
        ])
        ->latest()
        ->paginate(10);
    
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create', [
            'faculties' => Faculty::orderBy('name')->get(),
            'groups' => Group::orderBy('name')->get(),
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create($request->safe()->only([
                'name',
                'surname',
                'phone_number',
                'username',
                'password',
            ]) + ['role' => 'student']);

            Student::create($request->safe()->only([
                'faculty_id',
                'group_id',
                'specialty',
                'course_year',
                'student_id_card_number',
            ]) + ['user_id' => $user->id]);
        });

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student created.');
    }

    public function destroy(Student $student)
    {
        $student->user()->delete();

        return back()->with('success', 'Student deleted.');
    }
}