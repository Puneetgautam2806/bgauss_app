<!-- Footer -->
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
  <!-- / Footer -->

  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->



<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

<!-- Theme Switcher JS -->
<script>
$(document).ready(function() {
    // Initialize theme from localStorage or set to light as default
    let currentTheme = localStorage.getItem('theme') || 'light';
    applyTheme(currentTheme);
    updateThemeUI(currentTheme);
    
    // Theme toggle button click handler
    $('#themeToggler').on('click', function() {
        toggleTheme();
    });
    
    // Theme dropdown click handler
    $('#themeDropdownToggle').on('click', function() {
        toggleTheme();
    });
    
    function toggleTheme() {
        currentTheme = currentTheme === 'light' ? 'dark' : 'light';
        applyTheme(currentTheme);
        updateThemeUI(currentTheme);
        localStorage.setItem('theme', currentTheme);
        
        // Add animation class
        $('#themeIcon').addClass('theme-icon-rotate');
        setTimeout(function() {
            $('#themeIcon').removeClass('theme-icon-rotate');
        }, 300);
    }
    
    function applyTheme(theme) {
        const htmlRoot = document.getElementById('htmlRoot');
        const body = document.body;
        
        // Add transition class to prevent flashing
        document.documentElement.classList.add('theme-transitioning');
        
        // Use requestAnimationFrame for smoother transition
        requestAnimationFrame(function() {
            if (theme === 'dark') {
                htmlRoot.setAttribute('data-style', 'dark');
                htmlRoot.classList.remove('light-style');
                htmlRoot.classList.add('dark-style');
            } else {
                htmlRoot.setAttribute('data-style', 'light');
                htmlRoot.classList.remove('dark-style');
                htmlRoot.classList.add('light-style');
            }
            
            // Remove transition class after animation completes
            setTimeout(function() {
                document.documentElement.classList.remove('theme-transitioning');
            }, 200);
        });
    }
    
    function updateThemeUI(theme) {
        const themeIcon = $('#themeIcon');
        const themeDropdownIcon = $('#themeDropdownIcon');
        const themeDropdownText = $('#themeDropdownText');
        const themeToggler = $('#themeToggler');
        
        if (theme === 'dark') {
            // Update main toggle button
            themeIcon.removeClass('bx-moon').addClass('bx-sun');
            themeToggler.attr('title', 'Switch to Light Mode');
            
            // Update dropdown option
            themeDropdownIcon.removeClass('bx-palette').addClass('bx-sun');
            themeDropdownText.text('Light Mode');
        } else {
            // Update main toggle button
            themeIcon.removeClass('bx-sun').addClass('bx-moon');
            themeToggler.attr('title', 'Switch to Dark Mode');
            
            // Update dropdown option
            themeDropdownIcon.removeClass('bx-sun').addClass('bx-palette');
            themeDropdownText.text('Dark Mode');
        }
    }
    
    // Listen for system theme changes (optional)
    if (window.matchMedia) {
        const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        mediaQuery.addEventListener('change', function(e) {
            if (!localStorage.getItem('theme')) {
                const systemTheme = e.matches ? 'dark' : 'light';
                currentTheme = systemTheme;
                applyTheme(currentTheme);
                updateThemeUI(currentTheme);
            }
        });
    }
});
</script>

@stack('scripts')
</body>
</html>
