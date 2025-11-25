@extends('master_layout')
@section('title', 'Menu List')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Menu List</h4>
                    <a href="{{ route('menus.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus me-1"></i> Add New Menu
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap">#</th>
                                    <th class="text-nowrap">Menu Name</th>
                                    <th class="text-nowrap">Path</th>
                                    <th class="text-nowrap">Icon</th>
                                    <th class="text-nowrap">Order</th>
                                    <th class="text-nowrap">Parent</th>
                                    <th class="text-nowrap">Display</th>
                                    <th class="text-nowrap">Is Parent</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($menus as $index => $menu)
                                    <tr>
                                        <td class="text-nowrap">{{ $index + 1 }}</td>
                                        <td class="text-nowrap">{{ $menu->menu_name }}</td>
                                        <td class="text-nowrap">{{ $menu->path ?? '-' }}</td>
                                        <td class="text-nowrap"><i class="{{ $menu->icon }}"></i> {{ $menu->icon }}</td>
                                        <td class="text-nowrap">{{ $menu->order }}</td>
                                        <td class="text-nowrap">{{ $menu->parent_id ? $menus->firstWhere('id', $menu->parent_id)->menu_name : '—' }}</td>
                                        <td class="text-nowrap">{{ $menu->display ? 'Show' : 'Hide' }}</td>
                                        <td class="text-nowrap">{{ $menu->is_parent ? 'Yes' : 'No' }}</td>
                                        <td class="text-nowrap">
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('menus.edit', $menu->id) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this menu?')">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No menus found.</td>
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
        // custom JS if needed
    });
</script>
@endpush
