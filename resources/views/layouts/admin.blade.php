<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="tinymce-base" content="{{ asset('js/tinymce') }}">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/select2-bootstrap-5-theme/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset(\App\Helpers\SiteConfigHelper::siteFavicon()) }}">

    <style>
        /* Keep mobile offcanvas out of document flow (avoids duplicate nav if CSS is slow) */
        #sidebarMenu:not(.show) {
            visibility: hidden;
            position: fixed;
            left: -100%;
        }

        /* Enhanced CSS for better styling */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.5rem;
        }
        
        .navbar {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        
        .btn {
            border-radius: 0.375rem;
            font-weight: 500;
        }
        
        .form-control, .form-select {
            border-radius: 0.375rem;
            border: 1px solid #ced4da;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        
        .nav-link {
            border-radius: 0.375rem;
            padding: 0.75rem 1rem;
            margin-bottom: 0.25rem;
            color: #6c757d;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background-color: #f8f9fa;
            color: #495057;
        }
        
        .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }
        
        .nav-link i {
            width: 1.25rem;
            text-align: center;
        }

        .admin-sidebar-card {
            position: sticky;
            top: 1rem;
            max-height: calc(100vh - 2rem);
            overflow: auto;
        }

        .admin-sidebar-nav {
            gap: 0.1rem;
        }

        .admin-nav-toggle {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-align: left;
            border: 0;
            background: transparent;
            cursor: pointer;
        }

        .admin-nav-toggle-label {
            display: inline-flex;
            align-items: center;
            min-width: 0;
        }

        .admin-nav-caret {
            font-size: 0.75rem;
            transition: transform 0.2s ease;
            flex-shrink: 0;
        }

        .admin-nav-toggle[aria-expanded="true"] .admin-nav-caret,
        .admin-nav-group.is-open > .admin-nav-toggle .admin-nav-caret {
            transform: rotate(180deg);
        }

        .admin-nav-toggle.active-group {
            background-color: #e7f1ff;
            color: #0d6efd;
            font-weight: 600;
        }

        .admin-nav-children {
            padding: 0.15rem 0 0.35rem 0.55rem;
            margin-left: 0.55rem;
            border-left: 2px solid #e9ecef;
        }

        .admin-nav-child {
            padding: 0.55rem 0.85rem;
            font-size: 0.925rem;
            margin-bottom: 0.1rem;
        }
        
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        
        .text-danger {
            color: #dc3545 !important;
        }
        
        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #dc3545;
        }
        
        .is-invalid {
            border-color: #dc3545;
        }
        
        .is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
        
        .badge {
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
        }
        
        .list-unstyled li {
            padding: 0.25rem 0;
        }
        
        .border-bottom {
            border-bottom: 1px solid #dee2e6 !important;
        }
        
        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }
        
        /* TinyMCE Styling */
        .tox-tinymce {
            border-radius: 0.375rem !important;
            border: 1px solid #ced4da !important;
        }
        .tox .tox-edit-area__iframe {
            background: #fff;
        }
        .tox-tinymce-aux {
            z-index: 1100 !important;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <x-admin-navbar />
    
    <div class="min-vh-100 bg-light">
        <!-- Main Content -->
        <div class="container-fluid py-4">
            <div class="row align-items-start">
                <x-admin-sidebar :current-route="$currentRoute ?? null" />
                
                <!-- Main Content Area -->
                <div class="col-12 col-md-9 col-lg-10">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Select2 JS -->
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/custom.js') }}"></script>
    
    @if(auth()->check() && !auth()->user()->canDelete())
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('form').forEach(function (form) {
            const method = form.querySelector('input[name="_method"]');
            if (method && method.value.toUpperCase() === 'DELETE') {
                form.remove();
            }
        });
    });
    </script>
    @endif

    <!-- TinyMCE (replaces CKEditor everywhere) -->
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/admin-tinymce.js') }}"></script>
    @stack('scripts')
</body>
</html>
