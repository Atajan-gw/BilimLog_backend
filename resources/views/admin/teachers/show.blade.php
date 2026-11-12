@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3>
                {{ $teacher->name }}
                {{ $teacher->surname }}
            </h3>

            <p class="text-muted mb-0">Teacher information</p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-secondary">
            Back to Dashboard
        </a>

    </div>


    {{-- Teacher information --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <h5>Teacher Details</h5>

            <p>
                <strong>Name:</strong>
                {{ $teacher->name }} {{ $teacher->surname }}
            </p>

            <p>
                <strong>Phone:</strong>
                {{ $teacher->phone_number ?? 'Not available' }}
            </p>

            <p class="mb-0">
                <strong>Username:</strong>
                {{ $teacher->username }}
            </p>

        </div>
    </div>


    {{-- Teacher groups --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                Teacher Groups ({{ $teacher->groups->count() }})
            </h5>
        </div>

        <div class="card-body">

            <div class="row g-3">

                @forelse($teacher->groups as $group)

                    <div class="col-md-4">

                        <div class="card h-100 shadow-sm">

                            <div class="card-body">

                                <h5>{{ $group->name }}</h5>

                                <p class="text-muted">
                                    Students: {{ $group->students->count() }}
                                </p>

                                <a href="{{ route('admin.groups.show', $group->id) }}"
                                   class="btn btn-primary btn-sm">
                                    View Group
                                </a>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">
                        <p class="text-muted">
                            This teacher has no groups.
                        </p>
                    </div>

                @endforelse

            </div>

        </div>
    </div>

</div>

@endsection