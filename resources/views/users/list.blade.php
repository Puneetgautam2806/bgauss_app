@extends('master_layout')
@section('title', 'User List')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">User List</h4>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus me-1"></i> Add New User
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap">#</th>
                                    <th class="text-nowrap">Name</th>
                                    <th class="text-nowrap">Email</th>
                                    <th class="text-nowrap">Mobile</th>
                                    <th class="text-nowrap">User Type</th>
                                    <th class="text-nowrap">Status</th>
                                    <th class="text-nowrap">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $index => $user)
                                <tr>
                                    <td class="text-nowrap">{{ $index + 1 }}</td>
                                    <td class="text-nowrap" title="{{ $user->name }}"><strong>{{ $user->name }}</strong></td>
                                    <td class="text-nowrap" title="{{ $user->email }}">{{ $user->email }}</td>
                                    <td class="text-nowrap" title="{{ $user->mobile }}">{{ $user->mobile }}</td>
                                    <td class="text-nowrap">
                                        @if($user->usertype == 'admin')
                                            <span class="badge bg-label-info">Admin</span>
                                        @else
                                            <span class="badge bg-label-secondary">User</span>
                                        @endif
                                    </td>
                                    <td class="text-nowrap">
                                        @if($user->status == 1)
                                            <span class="badge bg-label-success">Active</span>
                                        @else
                                            <span class="badge bg-label-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">No users found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Optional: custom JS or initialize plugins
    });
</script>
@endpush
