@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3>{{ $group->name }}</h3>
            <p class="text-muted mb-0">Group information</p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-secondary">
            Back to Dashboard
        </a>

    </div>


    {{-- Teacher --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white">
            <h5 class="mb-0">Group Teacher</h5>
        </div>

        <div class="card-body">

            @if($group->teacher)

                <h5>
                    {{ $group->teacher->name }}
                    {{ $group->teacher->surname }}
                </h5>

                <p class="text-muted mb-2">
                    {{ $group->teacher->phone_number }}
                </p>

                <a href="{{ route('admin.teachers.show', $group->teacher->id) }}"
                   class="btn btn-outline-primary btn-sm">
                    View Teacher
                </a>

            @else

                <p class="text-muted mb-0">
                    No teacher assigned.
                </p>

            @endif

        </div>
    </div>


    {{-- Students --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                Students ({{ $group->students->count() }})
            </h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover table-striped align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Phone</th>
                            <th>Username</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($group->students as $student)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->user?->name }}</td>
                                <td>{{ $student->user?->surname }}</td>
                                <td>{{ $student->user?->phone_number }}</td>
                                <td>{{ $student->user?->username }}</td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No students in this group.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

@endsection