<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')
            ->withCount('groups')
            ->latest()
            ->paginate(10);

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'string', 'min:6'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'teacher';
        unset($data['avatar']);

        $teacher = User::create($data);

        if ($request->hasFile('avatar')) {
            $teacher->replaceAvatar($request->file('avatar'));
        }

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher successfully created.');
    }

    public function show(User $teacher)
    {
        abort_unless($teacher->role === 'teacher', 404);

        $teacher->load('groups.students.user');

        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(User $teacher)
    {
        abort_unless($teacher->role === 'teacher', 404);

        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, User $teacher)
    {
        abort_unless($teacher->role === 'teacher', 404);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'username' => [
                'required', 'string', 'max:255',
                Rule::unique('users', 'username')->ignore($teacher->id),
            ],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'password' => ['nullable', 'string', 'min:6'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        unset($data['avatar']);

        $teacher->update($data);

        if ($request->hasFile('avatar')) {
            $teacher->replaceAvatar($request->file('avatar'));
        }

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher successfully updated.');
    }

    public function destroy(User $teacher)
    {
        abort_unless($teacher->role === 'teacher', 404);

        if ($teacher->groups()->exists()) {
            return back()->with(
                'error',
                'This teacher has groups. Assign another teacher before deleting.'
            );
        }

        $teacher->delete();

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher successfully deleted.');
    }
}
