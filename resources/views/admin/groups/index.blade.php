
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Groups</h3>
        <a href="{{ route('admin.groups.create') }}" class="btn btn-primary">
            + Add Group
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
                        <th>Group</th>
                        <th>Teacher</th>
                        <th>Students</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($groups as $group)
                    <tr>
                        <td>{{ $groups->firstItem() + $loop->index }}</td>
                        <td>{{ $group->name }}</td>
                        <td>
                            @if ($group->teacher)
                                <div class="d-flex align-items-center gap-2">
                                    @include('admin.partials.avatar', [
                                        'avatarUrl' => $group->teacher->avatar_url,
                                        'name' => $group->teacher->name,
                                    ])
                                    <span>{{ $group->teacher->name }}</span>
                                </div>
                            @else
                                Not assigned
                            @endif
                        </td>
                        <td>{{ $group->students_count }}</td>
                        <td>
                            <a href="{{ route('admin.groups.show', $group) }}"
                               class="btn btn-sm btn-info">View</a>

                            <a href="{{ route('admin.groups.edit', $group) }}"
                               class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('admin.groups.destroy', $group) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this group?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            No groups found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $groups->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
