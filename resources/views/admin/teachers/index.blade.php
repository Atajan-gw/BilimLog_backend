
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Teachers</h3>
        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
            + Add Teacher
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>Groups</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $teacher)
                    <tr>
                        <td>{{ $teachers->firstItem() + $loop->index }}</td>
                        <td>{{ $teacher->name }} {{ $teacher->surname }}</td>
                        <td>{{ $teacher->username }}</td>
                        <td>{{ $teacher->phone_number ?? '-' }}</td>
                        <td>{{ $teacher->groups_count }}</td>
                        <td>
                            <a href="{{ route('admin.teachers.show', $teacher) }}"
                               class="btn btn-sm btn-info">View</a>

                            <a href="{{ route('admin.teachers.edit', $teacher) }}"
                               class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('admin.teachers.destroy', $teacher) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this teacher?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No teachers found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $teachers->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
