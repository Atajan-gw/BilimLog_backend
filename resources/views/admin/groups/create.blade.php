@extends('admin.layouts.app')

@section('content')

@php
$faculties = \App\Models\Faculty::all();
$teachers = \App\Models\User::where('role', 'teacher')->get();
@endphp
<div class="container-fluid">
    <h3 class="mb-4">Add New Group</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.groups.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Group Name</label>
                    <input type="text" name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="course_number" class="form-label">
                        Course Number
                    </label>

                    <select name="course_number" id="course_number"
                        class="form-select" required>
                        <option value="">Select Course</option>
                        @for($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}">{{ $i }}-course</option>
                            @endfor
                    </select>

                    @error('course_number')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Teacher</label>
                    <select name="teacher_id" class="form-select">
                        <option value="">Select teacher</option>
                        @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}"
                            @selected(old('teacher_id')==$teacher->id)>
                            {{ $teacher->name }} {{ $teacher->surname }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="faculty_id" class="form-label">Faculty</label>

                    <select name="faculty_id" id="faculty_id" class="form-select" required>
                        <option value="">Select Faculty</option>

                        @foreach($faculties as $faculty)
                        <option value="{{ $faculty->id }}">
                            {{ $faculty->name }}
                        </option>
                        @endforeach
                    </select>

                    @error('faculty_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary">Save Group</button>
                <a href="{{ route('admin.groups.index') }}"
                    class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection