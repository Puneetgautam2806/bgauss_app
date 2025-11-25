@extends('master_layout');
@section('title', 'Create User')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ isset($user) ? 'Edit User' : 'Create User' }}</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label" for="name">Location</label>
                             <select class="form-select @error('location') is-invalid @enderror" name="location" id="location" required>
                                <option>Select Location</option>
                                <option value="Pune" {{ isset($user) && $user->location == 'Pune' ? 'selected' : '' }}>Pune</option>
                                <option value="Chennai" {{ isset($user) && $user->location == 'Chennai' ? 'selected' : '' }}>Chennai</option>
                                <option value="Banglore" {{ isset($user) && $user->location == 'Banglore' ? 'selected' : '' }}>Banglore</option>
                                {{-- <option value="user" {{ old('location') == 'user' ? 'selected' : '' }}>User</option> --}}
                            </select>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="repair_type">Repair Type</label>
                            <select class="form-select @error('repair_type') is-invalid @enderror" name="repair_type" id="repair_type" required>
                                <option>Select Repair Type</option>
                                <option value="Charger" {{ isset($user) && $user->repair_type == 'Charger' ? 'selected' : '' }}>Charger</option>
                                <option value="moter" {{ isset($user) && $user->repair_type == 'moter' ? 'selected' : '' }}>Moter</option>
                                {{-- <option value="user" {{ old('repair_type') == 'user' ? 'selected' : '' }}>User</option> --}}
                            </select>
                            @error('repair_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Please Provide User Name" required value="{{ isset($user) ? $user->name : old('name') }}" />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Please Provide your Email" required value="{{ isset($user) ? $user->email : old('email') }}" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <span class="input-group-text">@example.com</span>
                            </div>
                            <div class="form-text">You can use letters, numbers & periods</div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Please Provide User Password" {{ isset($user) ? '' : 'required' }} />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <span class="input-group-text"><span class="fa fa-eye"></span></span>
                            </div>
                        </div>
                       <div class="col-md-6">
                            <label class="form-label" for="confirm_password">Confirm Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" id="confirm_password" placeholder="Please Confirm User Password" {{ isset($user) ? '' : 'required' }} />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <span class="input-group-text"><span class="fa fa-eye"></span></span>
                            </div>
                        </div>
                    </div>
                    {{-- Row 2: email + Password --}}
                    

                    {{-- Row 2: Name + User Type --}}
                    <div class="row mb-4">
                         <div class="col-md-6">
                            <label class="form-label" for="mobile">Mobile</label>
                            <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" id="mobile" placeholder="Please Provide Mobile Number   " required value="{{ isset($user) ? $user->mobile : old('mobile') }}" />
                            @error('mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="user_type">User Type</label>
                            <select class="form-select @error('user_type') is-invalid @enderror" name="user_type" id="user_type" required>
                                <option>Select User</option>
                                <option value="admin" {{ isset($user) && $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ isset($user) && $user->usertype == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('user_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Row 3: mobile +  Department --}}
                    

                    {{-- Row 4: Status --}}
                    <div class="mb-4">
                        <label class="form-label d-block" for="status">Status</label>
                        <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status1" value="1"   {{ isset($user) && $user->status == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status1">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status2" value="2" {{ isset($user) && $user->status == '2' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status2">In-Active</label>
                        </div>
                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Row 5: Remarks --}}
                    <div class="mb-4">
                        <label class="form-label" for="basic-default-message">Remark</label>
                        <textarea id="basic-default-message" class="form-control" name="remark" placeholder="Hi, Do you have a Remarks?" > {{ isset($user) ? $user->remark : old('remark') }}</textarea> 
                    </div>

                    <input type="submit" name="submit" value=" {{ isset($user) ? 'Update' : 'Create' }}" class="btn btn-primary" />

                </div>
            </div>
            <input type="hidden" name="user_id" value="{{ isset($user) ? $user->id : ''  }}">
        </div>
    </div>
</form>
</div>



@endsection