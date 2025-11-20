<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'UKMI Ar-Rahman'))</title>

    <!-- Tabler CSS -->
    <link rel="stylesheet" href="{{ asset('templates/dist/css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/dist/css/tabler-flags.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/dist/css/tabler-payments.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/dist/css/tabler-social.min.css') }}">

    <style>
        /* Ensure top navbar is fixed and visible on all devices */
        header.navbar {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 1030 !important;
            background: var(--tblr-bg-surface) !important;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
            display: flex !important;
            width: 100% !important;
        }
        
        /* Ensure navbar container is visible */
        header.navbar .container-xl {
            width: 100%;
            max-width: 100%;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        /* Desktop: navbar aligned with page-content */
        @media (min-width: 992px) {
            header.navbar {
                left: 15rem !important;
                width: calc(100% - 15rem) !important;
            }
        }
        
        /* Ensure content area doesn't get covered by sidebar and navbar */
        .page-wrapper {
            display: flex;
            flex-direction: row;
            min-height: 100vh;
            padding-top: 3.5rem; /* Space for top navbar */
        }
        
        .navbar-vertical {
            position: fixed;
            top: 3.5rem; /* Below top navbar */
            left: 0;
            height: calc(100vh - 3.5rem);
            z-index: 1020;
            width: 15rem;
            overflow-y: auto;
            background: transparent !important;
            border-right: 1px solid rgba(var(--tblr-border-color-rgb), 0.1);
        }
        
        .page-content {
            margin-left: 0;
            width: 100%;
            flex: 1;
            display: flex;
            flex-direction: column;
            padding-top: 0;
        }
        
        .page-header,
        .page-body,
        .footer {
            width: 100%;
        }
        
        /* Desktop: sidebar visible, content has left margin */
        @media (min-width: 992px) {
            .page-content {
                margin-left: 15rem;
            }
            
            .navbar-vertical {
                transform: translateX(0);
            }
            
            /* Transparent sidebar nav links */
            .navbar-vertical .nav-link {
                color: var(--tblr-body-color) !important;
            }
            
            .navbar-vertical .nav-link:hover,
            .navbar-vertical .nav-link.active {
                background-color: rgba(var(--tblr-primary-rgb), 0.1);
                color: var(--tblr-primary) !important;
            }
        }
        
        /* Mobile/Tablet: sidebar hidden by default, navbar always visible */
        @media (max-width: 991.98px) {
            .page-wrapper {
                padding-top: 3.5rem; /* Keep space for navbar */
            }
            
            .navbar-vertical {
                position: fixed;
                top: 3.5rem;
                left: 0;
                height: calc(100vh - 3.5rem);
                width: 16rem;
                max-width: 75vw;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1020;
                overflow-y: auto;
                overflow-x: hidden;
                box-shadow: 2px 0 8px rgba(0, 0, 0, 0.15);
                background-color: rgba(var(--tblr-bg-surface-rgb), 0.95) !important;
                backdrop-filter: blur(10px);
                visibility: hidden;
                opacity: 0;
                border-right: 1px solid rgba(var(--tblr-border-color-rgb), 0.1);
            }
            
            .navbar-vertical.show {
                transform: translateX(0);
                visibility: visible !important;
                opacity: 1 !important;
            }
            
            /* Ensure sidebar menu is always visible on mobile */
            .navbar-vertical .navbar-collapse {
                display: flex !important;
                flex-direction: column;
                flex-grow: 1;
                height: 100%;
                visibility: visible !important;
                opacity: 1 !important;
            }
            
            .navbar-vertical .navbar-nav {
                display: flex !important;
                flex-direction: column;
                width: 100%;
                padding: 0.5rem 0;
                visibility: visible !important;
                opacity: 1 !important;
            }
            
            .navbar-vertical .nav-item {
                display: block !important;
                width: 100%;
                visibility: visible !important;
                opacity: 1 !important;
            }
            
            .navbar-vertical .nav-link {
                display: flex !important;
                align-items: center;
                padding: 0.75rem 1.25rem;
                width: 100%;
                color: var(--tblr-body-color) !important;
                text-decoration: none;
                transition: all 0.2s;
                visibility: visible !important;
                opacity: 1 !important;
            }
            
            .navbar-vertical .nav-link:hover,
            .navbar-vertical .nav-link.active {
                background-color: rgba(var(--tblr-primary-rgb), 0.1);
                color: var(--tblr-primary) !important;
            }
            
            .navbar-vertical .nav-link-icon {
                display: inline-flex !important;
                align-items: center;
                justify-content: center;
                width: 1.5rem;
                height: 1.5rem;
                margin-right: 0.75rem;
                flex-shrink: 0;
                visibility: visible !important;
                opacity: 1 !important;
            }
            
            .navbar-vertical .nav-link-icon svg {
                width: 100%;
                height: 100%;
            }
            
            .navbar-vertical .nav-link-title {
                display: inline-block !important;
                flex: 1;
                white-space: nowrap;
                visibility: visible !important;
                opacity: 1 !important;
                font-size: 0.9rem;
            }
            
            /* Sidebar header for mobile */
            .navbar-vertical > .container-fluid > div:first-child {
                visibility: visible !important;
                opacity: 1 !important;
            }
            
            .page-content {
                margin-left: 0;
            }
            
            /* Overlay when sidebar is open on mobile */
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 3.5rem;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1019;
                backdrop-filter: blur(2px);
            }
            
            .sidebar-overlay.show {
                display: block;
            }
            
            /* Shift content when sidebar is open */
            .page-content.sidebar-open {
                transform: translateX(16rem);
                transition: transform 0.3s ease;
            }
            
            /* Ensure navbar is always visible on mobile and full width */
            header.navbar {
                display: flex !important;
                visibility: visible !important;
                opacity: 1 !important;
                left: 0 !important;
                width: 100% !important;
            }
            
            /* Navbar container on mobile */
            header.navbar .container-xl {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
        }
        
        /* Perbaikan tampilan pagination */
        .pagination {
            margin: 0;
            gap: 0.25rem;
        }
        
        .pagination .page-item {
            margin: 0;
        }
        
        .pagination .page-link {
            min-width: 2.5rem;
            text-align: center;
            border-radius: var(--tblr-border-radius);
            border: 1px solid var(--tblr-border-color);
            color: var(--tblr-body-color);
            background-color: var(--tblr-bg-surface);
            transition: all 0.2s;
        }
        
        .pagination .page-link:hover {
            background-color: var(--tblr-active-bg);
            border-color: var(--tblr-primary);
            color: var(--tblr-primary);
            z-index: 1;
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--tblr-primary);
            border-color: var(--tblr-primary);
            color: #ffffff;
            font-weight: 600;
        }
        
        .pagination .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
            background-color: var(--tblr-bg-surface);
            border-color: var(--tblr-border-color);
            color: var(--tblr-disabled-color);
        }
        
        .pagination .page-link svg {
            width: 1rem;
            height: 1rem;
            vertical-align: middle;
        }
        
        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            padding: 0.5rem 0.75rem;
        }
        
        /* Perbaikan kontras badge untuk keterbacaan yang lebih baik */
        .badge {
            font-weight: 600;
            padding: 0.35em 0.65em;
            letter-spacing: 0.02em;
        }
        
        /* Badge biru dengan kontras lebih baik */
        .badge.bg-blue {
            background-color: #206bc4 !important;
            color: #ffffff !important;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        
        /* Badge info dengan kontras lebih baik */
        .badge.bg-info {
            background-color: #4299e1 !important;
            color: #ffffff !important;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        
        /* Badge hijau dengan kontras lebih baik */
        .badge.bg-green,
        .badge.bg-success {
            background-color: #2fb344 !important;
            color: #ffffff !important;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        
        /* Badge merah dengan kontras lebih baik */
        .badge.bg-red,
        .badge.bg-danger {
            background-color: #d63939 !important;
            color: #ffffff !important;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        
        /* Badge kuning/orange dengan kontras lebih baik */
        .badge.bg-yellow,
        .badge.bg-warning {
            background-color: #f59f00 !important;
            color: #ffffff !important;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        
        .badge.bg-orange {
            background-color: #fd7e14 !important;
            color: #ffffff !important;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        
        /* Badge purple dengan kontras lebih baik */
        .badge.bg-purple {
            background-color: #ae3ec9 !important;
            color: #ffffff !important;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        
        /* Badge secondary dengan kontras lebih baik */
        .badge.bg-secondary {
            background-color: #6c757d !important;
            color: #ffffff !important;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        
        /* Styling untuk sub menu - dropdown ke bawah vertikal */
        .navbar-vertical .collapse {
            margin-left: 0 !important;
            padding-left: 0 !important;
            margin-top: 0.25rem;
        }
        
        .navbar-vertical .nav-sub {
            list-style: none;
            padding: 0.5rem 0 !important;
            margin: 0.25rem 0 0.5rem 0 !important;
            background-color: rgba(var(--tblr-bg-surface-rgb), 0.6);
            border-radius: var(--tblr-border-radius);
            border: 1px solid rgba(var(--tblr-border-color-rgb), 0.1);
            margin-left: 0 !important;
            padding-left: 0 !important;
            width: 100%;
        }
        
        .navbar-vertical .nav-sub .nav-item {
            margin: 0 !important;
            padding: 0 !important;
            width: 100%;
        }
        
        .navbar-vertical .nav-sub .nav-link {
            padding: 0.625rem 1.5rem !important;
            color: var(--tblr-body-color);
            font-size: 0.875rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            text-decoration: none;
            border-left: 3px solid transparent;
            position: relative;
            width: 100%;
            margin-left: 0 !important;
            padding-left: 1.5rem !important;
        }
        
        .nav-sub .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background-color: transparent;
            transition: background-color 0.2s;
        }
        
        .nav-sub .nav-link:hover {
            background-color: rgba(var(--tblr-primary-rgb), 0.08);
            color: var(--tblr-primary);
        }
        
        .nav-sub .nav-link:hover::before {
            background-color: var(--tblr-primary);
        }
        
        .nav-sub .nav-link.active {
            background-color: rgba(var(--tblr-primary-rgb), 0.12);
            color: var(--tblr-primary);
            font-weight: 600;
        }
        
        .nav-sub .nav-link.active::before {
            background-color: var(--tblr-primary);
        }
        
        .nav-sub .nav-link-title {
            flex: 1;
        }
        
        /* Arrow indicator untuk menu dengan sub menu */
        .nav-link-arrow {
            transition: transform 0.2s ease;
            display: flex;
            align-items: center;
            opacity: 0.6;
            flex-shrink: 0;
        }
        
        .nav-link:hover .nav-link-arrow {
            opacity: 1;
        }
        
        .nav-link[aria-expanded="true"] .nav-link-arrow,
        .nav-link[aria-expanded="true"] .nav-link-arrow svg {
            transform: rotate(90deg);
            opacity: 1;
        }
        
        .nav-link[aria-expanded="true"] .nav-link-arrow svg {
            color: var(--tblr-primary);
        }
        
        /* Pastikan arrow tidak terpengaruh transform dari parent */
        .nav-link-arrow svg {
            transition: transform 0.2s ease, color 0.2s ease;
        }
        
        /* Collapse animation */
        .collapse {
            transition: height 0.35s ease;
        }
        
        .collapse:not(.show) {
            display: none;
        }
        
        .collapse.show {
            display: block;
        }
        
        /* Styling untuk nav-link yang punya sub menu */
        .nav-link[data-bs-toggle="collapse"] {
            cursor: pointer;
        }
        
        .nav-link[data-bs-toggle="collapse"]:hover {
            background-color: rgba(var(--tblr-primary-rgb), 0.05);
        }
        
        .nav-link[data-bs-toggle="collapse"].active {
            background-color: rgba(var(--tblr-primary-rgb), 0.1);
        }
    </style>

    @stack('styles')
</head>
<body>
    <script src="{{ asset('templates/dist/js/demo-theme.min.js') }}"></script>
    
    <div class="page">
        @include('layouts.partials.navbar')
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        <div class="page-wrapper">
            @include('layouts.partials.sidebar')
            
            <div class="page-content">
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <div class="page-pretitle">
                                    @yield('pretitle', 'Dashboard')
                                </div>
                                <h2 class="page-title">
                                    @yield('title', 'Dashboard')
                                </h2>
                            </div>
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                    @yield('header-actions')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-body">
                    <div class="container-xl">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <div class="d-flex">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                    </div>
                                    <div>
                                        {{ session('success') }}
                                    </div>
                                </div>
                                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                            </div>
                        @endif

                        @if(isset($errors) && $errors->any())
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <div class="d-flex">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                                    </div>
                                    <div>
                                        <h4 class="alert-title">Terjadi Kesalahan!</h4>
                                        <div class="text-secondary">
                                            <ul class="mb-0">
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>

                @include('layouts.partials.footer')
            </div>
        </div>
    </div>

    <!-- Tabler JS -->
    <script src="{{ asset('templates/dist/js/tabler.min.js') }}"></script>
    <script src="{{ asset('templates/dist/js/demo-theme.min.js') }}"></script>

    <script>
        // Handle sidebar toggle on mobile
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.navbar-vertical');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            function openSidebar() {
                if (sidebar) {
                    sidebar.classList.add('show');
                }
                if (sidebarOverlay) {
                    sidebarOverlay.classList.add('show');
                }
                document.body.style.overflow = 'hidden';
            }
            
            function closeSidebar() {
                if (sidebar) {
                    sidebar.classList.remove('show');
                }
                if (sidebarOverlay) {
                    sidebarOverlay.classList.remove('show');
                }
                document.body.style.overflow = '';
            }
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    openSidebar();
                });
            }
            
            if (sidebarCloseBtn) {
                sidebarCloseBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    closeSidebar();
                });
            }
            
            // Also close when clicking on nav links in mobile
            if (window.innerWidth <= 991.98) {
                const navLinks = document.querySelectorAll('.navbar-vertical .nav-link');
                navLinks.forEach(function(link) {
                    link.addEventListener('click', function() {
                        // Close sidebar after a short delay to allow navigation
                        setTimeout(function() {
                            closeSidebar();
                        }, 100);
                    });
                });
            }
            
            // Close sidebar when clicking overlay
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    closeSidebar();
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 991.98) {
                    const isClickInsideSidebar = sidebar && sidebar.contains(event.target);
                    const isClickOnToggle = sidebarToggle && sidebarToggle.contains(event.target);
                    
                    if (!isClickInsideSidebar && !isClickOnToggle && sidebar && sidebar.classList.contains('show')) {
                        closeSidebar();
                    }
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 991.98) {
                    closeSidebar();
                }
            });
            
            // Handle collapse untuk sub menu
            const collapseElements = document.querySelectorAll('[data-bs-toggle="collapse"]');
            collapseElements.forEach(function(element) {
                const targetId = element.getAttribute('data-bs-target');
                if (targetId) {
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        // Update aria-expanded saat collapse di-toggle
                        targetElement.addEventListener('show.bs.collapse', function() {
                            element.setAttribute('aria-expanded', 'true');
                        });
                        
                        targetElement.addEventListener('hide.bs.collapse', function() {
                            element.setAttribute('aria-expanded', 'false');
                        });
                    }
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
