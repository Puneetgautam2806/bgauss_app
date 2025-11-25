<!doctype html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>NativeCodeBase | Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />
     
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset(' assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card px-sm-6 px-0">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oh snap!</strong> {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> 
            @endif
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="#" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                   <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="50">
                    
                  </span>
                  <span class="app-brand-text demo text-heading fw-bold">Repair Panel</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-1">Welcome to Backoffice! </h4>
              <p class="mb-6">Please sign-in to your account</p>

              <form id="formAuthentication" class="mb-6" action="{{ route('LoginUser') }}" method="POST">
                @csrf
                  <div class="mb-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email"
                      placeholder="Enter your email" autofocus />
                  </div>
                  <div class="mb-6 form-password-toggle">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                      <input type="password" id="password" class="form-control" name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                  <div class="mb-8">
                    <div class="d-flex justify-content-between mt-8">
                      <div class="form-check mb-0 ms-2">
                        <input class="form-check-input" type="checkbox" id="remember-me" name="remember" value="1" />
                        <label class="form-check-label" for="remember-me"> Remember Me </label>
                      </div>
                      <a href="auth-forgot-password-basic.html">
                        <span>Forgot Password?</span>
                      </a>
                    </div>
                  </div>
                  <div class="mb-6">
                    <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
      <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl">
          <div
            class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
            <div class="text-body">
              ©
              <script>
                document.write(new Date().getFullYear());
              </script>
              , Powered by
              <a href="#" target="_blank" class="footer-link">NativeCodeBase</a>
            </div>
            {{-- <div class="d-none d-lg-inline-block">
              <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
              <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>
    
              <a
                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                target="_blank"
                class="footer-link me-4"
                >Documentation</a
              >
    
              <a
                href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                target="_blank"
                class="footer-link"
                >Support</a
              >
            </div> --}}
          </div>
        </div>
      </footer>
    </div>


   

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    
    <!-- Remember Me JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the remember me checkbox
            const rememberCheckbox = document.getElementById('remember-me');
            
            // Check if there was a previous remember me preference stored
            if (localStorage.getItem('rememberMeChecked') === 'true') {
                rememberCheckbox.checked = true;
            }
            
            // Save the preference when changed
            rememberCheckbox.addEventListener('change', function() {
                localStorage.setItem('rememberMeChecked', this.checked);
            });
            
            // Clear remember preference if login fails
            @if($errors->any())
                localStorage.removeItem('rememberMeChecked');
            @endif
        });
    </script>

  </body>
</html>
