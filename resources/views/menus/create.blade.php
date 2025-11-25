@extends('master_layout')
@section('title', 'Create Menu')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xl">
                <div class="card mb-6">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Create Menu</h4>
                    </div>
                    <div class="card-body">

                        {{-- Row 1: Menu Name + Path --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label" for="menu_name">Menu Name</label>
                                <input type="text" 
                                    class="form-control @error('menu_name') is-invalid @enderror" 
                                    name="menu_name" id="menu_name" 
                                    placeholder="Enter Menu Name" 
                                    value="{{ old('menu_name') }}" required>
                                @error('menu_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="path">Path</label>
                                <input type="text" 
                                    class="form-control @error('path') is-invalid @enderror" 
                                    name="path" id="path" 
                                    placeholder="/your-path" 
                                    value="{{ old('path') }}">
                                @error('path')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Row 2: Icon + Order --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label" for="icon">Icon</label>
                                <input type="text" 
                                    class="form-control @error('icon') is-invalid @enderror" 
                                    name="icon" id="icon" 
                                    placeholder="fa fa-home" 
                                    value="{{ old('icon') }}">
                                <div class="form-text">Use FontAwesome class, e.g. <code>fa fa-user</code></div>
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="order">Order</label>
                                <input type="number" 
                                    class="form-control @error('order') is-invalid @enderror" 
                                    name="order" id="order" 
                                    placeholder="0" 
                                    value="{{ old('order', 0) }}">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Row 3: Is Parent + Parent Menu --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Is Parent?</label>
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="is_parent" name="is_parent" value="1" {{ old('is_parent') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_parent">Yes</label>
                                </div>
                                @error('is_parent')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="parent_id">Parent Menu</label>
                                <select class="form-select @error('parent_id') is-invalid @enderror" name="parent_id" id="parent_id">
                                    <option value="">-- Select Parent Menu --</option>
                                    @foreach($parentMenus as $menu)
                                        <option value="{{ $menu->id }}" {{ old('parent_id') == $menu->id ? 'selected' : '' }}>
                                            {{ $menu->menu_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text">Leave blank if this is a parent menu.</div>
                                @error('parent_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Row 4: Display --}}
                        <div class="mb-4">
                            <label class="form-label d-block">Display</label>
                            <div class="form-check form-check-inline mt-2">
                                <input class="form-check-input @error('display') is-invalid @enderror" 
                                    type="radio" name="display" id="display1" 
                                    value="1" {{ old('display', 1) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="display1">Show</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('display') is-invalid @enderror" 
                                    type="radio" name="display" id="display2" 
                                    value="0" {{ old('display') == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="display2">Hide</label>
                            </div>
                            @error('display')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="submit" name="submit" value="Create Menu" class="btn btn-primary" />

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
