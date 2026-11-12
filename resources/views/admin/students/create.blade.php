
@extends('admin.layouts.app')

@section('title', 'Add Student')
@section('page-title', 'Add New Student')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">
        <h5 class="mb-0">Student Information</h5>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('admin.students.store') }}">
            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name"
                           class="form-control"
                           value="{{ old('name') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Surname</label>
                    <input type="text" name="surname"
                           class="form-control"
                           value="{{ old('surname') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone_number"
                           class="form-control"
                           value="{{ old('phone_number') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input type="text" name="username"
                           class="form-control"
                           value="{{ old('username') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" name="password"
                           class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Course Year</label>
                    <input type="number" name="course_year"
                           class="form-control" min="1" max="8"
                           value="{{ old('course_year') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Specialty</label>
                    <input type="text" name="specialty"
                           class="form-control"
                           value="{{ old('specialty') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Student ID Card</label>
                    <input type="text" name="student_id_card_number"
                           class="form-control"
                           value="{{ old('student_id_card_number') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Faculty</label>
                    <select name="faculty_id" class="form-select" required>
                        <option value="">Select Faculty</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}"
                                @selected(old('faculty_id') == $faculty->id)>
                                {{ $faculty->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Group</label>
                    <select name="group_id" class="form-select" required>
                        <option value="">Select Group</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}"
                                @selected(old('group_id') == $group->id)>
                                {{ $group->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="mt-4 d-flex gap-2">

                <button type="submit" class="btn btn-primary">
                    Save Student
                </button>

                <a href="{{ route('admin.students.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </div>

        </form>

    </div>
</div>

@endsection
