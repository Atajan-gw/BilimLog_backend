@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">Admin Dashboard</h3>

    {{-- Statistikalar --}}
    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Students</h6>
                    <h2 class="text-primary">{{ $studentsCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Groups</h6>
                    <h2 class="text-success">{{ $groupsCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Teachers</h6>
                    <h2 class="text-warning">{{ $teachersCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Users</h6>
                    <h2 class="text-info">{{ $usersCount }}</h2>
                </div>
            </div>
        </div>

    </div>

    {{-- Groups --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white">
            <h5 class="mb-0">Groups</h5>
        </div>

        <div class="card-body">

            <div class="row g-3">

                @forelse($groups as $group)

                    <div class="col-md-4 col-lg-3">

                        <a href="{{ route('admin.groups.show', $group->id) }}"
                           class="text-decoration-none text-dark">

                            <div class="card h-100 border shadow-sm">
                                <div class="card-body">

                                    <h5 class="text-primary">
                                        {{ $group->name }}
                                    </h5>

                                    <p class="mb-1">
                                        <strong>Teacher:</strong>
                                        {{ $group->teacher?->name ?? 'Not assigned' }}
                                    </p>

                                    <p class="mb-0 text-muted">
                                        Students: {{ $group->students_count }}
                                    </p>

                                </div>
                            </div>

                        </a>

                    </div>

                @empty

                    <div class="col-12">
                        <p class="text-muted mb-0">No groups found.</p>
                    </div>

                @endforelse

            </div>

        </div>
    </div>


    {{-- Teachers --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <h5 class="mb-0">Teachers</h5>
        </div>

        <div class="card-body">

            <div class="row g-3">

                @forelse($teachers as $teacher)

                    <div class="col-md-4 col-lg-3">

                        <a href="{{ route('admin.teachers.show', $teacher->id) }}"
                           class="text-decoration-none text-dark">

                            <div class="card h-100 shadow-sm border">
                                <div class="card-body">

                                    <h5 class="text-success">
                                        {{ $teacher->name }}
                                        {{ $teacher->surname }}
                                    </h5>

                                    <p class="mb-0 text-muted">
                                        Groups: {{ $teacher->groups_count }}
                                    </p>

                                </div>
                            </div>

                        </a>

                    </div>

                @empty

                    <div class="col-12">
                        <p class="text-muted mb-0">No teachers found.</p>
                    </div>

                @endforelse

            </div>

        </div>
    </div>

</div>

@endsection