<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStudentRequest;
use App\Http\Requests\Admin\UpdateStudentRequest;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with([
            'user',
            'faculty',
            'group',
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
        $user = DB::transaction(function () use ($request) {
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

            return $user;
        });

        if ($request->hasFile('avatar')) {
            $user->replaceAvatar($request->file('avatar'));
        }

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student created.');
    }

    public function edit(Student $student)
    {
        $student->load('user');

        abort_unless($student->user, 404);

        return view('admin.students.edit', [
            'student' => $student,
            'faculties' => Faculty::orderBy('name')->get(),
            'groups' => Group::orderBy('name')->get(),
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        DB::transaction(function () use ($request, $student) {
            $userData = $request->safe()->only([
                'name',
                'surname',
                'phone_number',
                'username',
            ]);

            if ($request->filled('password')) {
                $userData['password'] = $request->string('password')->toString();
            }

            $student->user->update($userData);

            $student->update($request->safe()->only([
                'faculty_id',
                'group_id',
                'specialty',
                'course_year',
                'student_id_card_number',
            ]));
        });

        if ($request->hasFile('avatar')) {
            $student->user->replaceAvatar($request->file('avatar'));
        }

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student updated.');
    }

    public function destroy(Student $student)
    {
        $student->user()->delete();

        return back()->with('success', 'Student deleted.');
    }
}
