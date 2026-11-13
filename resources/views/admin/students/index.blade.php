
@extends('admin.layouts.app')

@section('title', 'Students')
@section('page-title', 'Students Management')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">

        <h5 class="mb-0">All Students</h5>

        <a href="{{ route('admin.students.create') }}"
           class="btn btn-primary">
            + Add Student
        </a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-striped table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Faculty</th>
                        <th>Group</th>
                        <th>Course</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($students as $student)

                        <tr>
                            <td>{{ $student->id }}</td>

                            <td>
                                @include('admin.partials.avatar', [
                                    'avatarUrl' => $student->user->avatar_url,
                                    'name' => $student->user->name,
                                ])
                            </td>

                            <td>
                                {{ $student->user->name }}
                                {{ $student->user->surname }}
                            </td>

                            <td>{{ $student->user->username }}</td>

                            <td>{{ $student->faculty->name }}</td>

                            <td>{{ $student->group->name }}</td>

                            <td>{{ $student->course_year }}</td>

                            <td>
                                <div class="d-flex gap-2">

                                    <a href="{{ route('admin.students.edit', $student) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.students.destroy', $student) }}"
                                          onsubmit="return confirm('Delete student?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger"
                                                type="submit">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                No students found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">
            {{ $students->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

@endsection
