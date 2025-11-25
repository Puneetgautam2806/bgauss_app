@extends('master_layout')
@section('title', 'Edit Menu')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xl">
                <div class="card mb-6">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Menu</h4>
                        <a href="{{ route('menus.index') }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back me-1"></i> Back to List
                        </a>
                    </div>
                    <div class="card-body">

                        {{-- Row 1: Menu Name + Path --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label" for="menu_name">Menu Name</label>
                                <input type="text" class="form-control @error('menu_name') is-invalid @enderror"
                                       id="menu_name" name="menu_name"
                                       placeholder="Enter menu name"
                                       value="{{ old('menu_name', $menu->menu_name) }}" required>
                                @error('menu_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="path">Path</label>
                                <input type="text" class="form-control @error('path') is-invalid @enderror"
                                       id="path" name="path"
                                       placeholder="/dashboard"
                                       value="{{ old('path', $menu->path) }}">
                                @error('path')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Row 2: Icon + Order --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label" for="icon">Icon (optional)</label>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                       id="icon" name="icon"
                                       placeholder="e.g. bx bx-home"
                                       value="{{ old('icon', $menu->icon) }}">
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="order">Order</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror"
                                       id="order" name="order"
                                       value="{{ old('order', $menu->order) }}">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Row 3: Parent Menu + Is Parent --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label" for="parent_id">Parent Menu</label>
                                <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                                    <option value="">-- No Parent --</option>
                                    @foreach($parentMenus as $parent)
                                        <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>
                                            {{ $parent->menu_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Is Parent?</label>
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="is_parent" name="is_parent" value="1"
                                           {{ old('is_parent', $menu->is_parent) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_parent">Yes</label>
                                </div>
                            </div>
                        </div>

                        {{-- Row 4: Display --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Display</label>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="display" id="display1" value="1"
                                           {{ old('display', $menu->display) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="display1">Show</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="display" id="display0" value="0"
                                           {{ old('display', $menu->display) == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="display0">Hide</label>
                                </div>
                                @error('display')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Update Menu</button>
                                <a href="{{ route('menus.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
