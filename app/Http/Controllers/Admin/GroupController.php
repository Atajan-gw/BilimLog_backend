<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::with('teacher')
            ->withCount('students')
            ->latest()
            ->paginate(10);

        return view('admin.groups.index', compact('groups'));
    }

    public function create()
    {
        $teachers = User::where('role', 'teacher')->get();

        return view('admin.groups.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'teacher_id' => ['required', 'exists:users,id'],
            'faculty_id' => ['required', 'exists:faculties,id'],
            'course_number' => ['required', 'integer', 'min:1', 'max:6'],
        ]);

        abort_unless(
            User::where('id', $data['teacher_id'])
                ->where('role', 'teacher')
                ->exists(),
            422
        );

        Group::create($data);

        return redirect()->route('admin.groups.index')
            ->with('success', 'Group successfully created.');
    }

    public function show(Group $group)
    {
        $group->load(['teacher', 'students.user']);

        return view('admin.groups.show', compact('group'));
    }

    public function edit(Group $group)
    {
        $teachers = User::where('role', 'teacher')->get();

        return view('admin.groups.edit', compact('group', 'teachers'));
    }

    public function update(Request $request, Group $group)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'teacher_id' => ['nullable', 'exists:users,id'],
            'faculty_id' => ['required', 'exists:faculties,id'],
            'course_number' => ['required', 'integer', 'min:1', 'max:6'],
        ]);

        if (!empty($data['teacher_id'])) {
            abort_unless(
                User::where('id', $data['teacher_id'])
                    ->where('role', 'teacher')->exists(),
                422
            );
        }

        $group->update($data);

        return redirect()->route('admin.groups.index')
            ->with('success', 'Group successfully updated.');
    }

    public function destroy(Group $group)
    {
        if ($group->students()->exists()) {
            return back()->with(
                'error',
                'This group has students. Move the students before deleting it.'
            );
        }

        $group->delete();

        return redirect()->route('admin.groups.index')
            ->with('success', 'Group successfully deleted.');
    }
}
