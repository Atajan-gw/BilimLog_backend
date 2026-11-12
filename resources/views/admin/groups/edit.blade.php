@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Edit Group</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.groups.update', $group) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Group Name</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', $group->name) }}" required>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="course_number" class="form-label">
                        Course Number
                    </label>

                    <select name="course_number" id="course_number"
                        class="form-select" required>
                        @for($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}"
                            {{ old('course_number', $group->course_number) == $i ? 'selected' : '' }}>
                            {{ $i }}-course
                            </option>
                            @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Teacher</label>
                    <select name="teacher_id" class="form-select">
                        <option value="">Select teacher</option>
                        @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}"
                            @selected(old('teacher_id', $group->teacher_id) == $teacher->id)>
                            {{ $teacher->name }} {{ $teacher->surname }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="faculty_id" class="form-label">Faculty</label>

                    <select name="faculty_id" id="faculty_id" class="form-select" required>
                        @foreach(\App\Models\Faculty::all() as $faculty)
                        <option value="{{ $faculty->id }}"
                            {{ old('faculty_id', $group->faculty_id) == $faculty->id ? 'selected' : '' }}>
                            {{ $faculty->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary">Update Group</button>
                <a href="{{ route('admin.groups.index') }}"
                    class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection