@include('common_inc.header')
<x-menu-component />
@include('common_inc.top')
<div class="container-xxl flex-grow-1 container-p-y">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @hasSection('content')
        @yield('content')
    @else
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Welcome to the Backoffice</h5>
                        <p class="card-text">No Content Found !!</p>  
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@include('common_inc.footer')