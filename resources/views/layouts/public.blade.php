<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'UKMI Ar-Rahman') - Struktur Organisasi</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #206bc4;
            --secondary-color: #4299e1;
            --success-color: #2fb344;
            --danger-color: #d63939;
            --warning-color: #f59f00;
            --dark-color: #1a1a1a;
            --light-bg: #f8f9fa;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }
        
        .main-content {
            padding: 3rem 0;
            min-height: calc(100vh - 200px);
        }
        
        .org-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }
        
        .org-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .org-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .org-header h1 {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        
        .org-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .presidium-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 3rem 0;
            margin: 2rem 0;
            border-radius: 20px;
        }
        
        .presidium-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            border: 2px solid transparent;
        }
        
        .presidium-card:hover {
            border-color: var(--primary-color);
            transform: scale(1.05);
        }
        
        .presidium-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            object-fit: cover;
            border: 4px solid var(--primary-color);
        }
        
        .biro-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border-left: 5px solid var(--primary-color);
        }
        
        .biro-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .biro-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-right: 1rem;
        }
        
        .member-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .member-card:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }
        
        .member-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1rem;
            border: 2px solid var(--primary-color);
        }
        
        .badge-custom {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .section-title {
            font-weight: 700;
            font-size: 2rem;
            color: white;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .footer {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 2rem 0;
            margin-top: 4rem;
            text-align: center;
            color: #666;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #999;
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        @media (max-width: 768px) {
            .org-header h1 {
                font-size: 1.8rem;
            }
            
            .presidium-card {
                margin-bottom: 1rem;
            }
            
            .main-content {
                padding: 2rem 0;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('struktur-organisasi') }}">
                <i class="bi bi-building"></i> UKMI Ar-Rahman
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('struktur-organisasi') }}">
                            <i class="bi bi-diagram-3"></i> Struktur Organisasi
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content" style="margin-top: 80px;">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="mb-0">
                <strong>UKMI Ar-Rahman</strong> &copy; {{ date('Y') }} - Unit Kegiatan Mahasiswa Islam
            </p>
            <p class="mb-0 mt-2 text-muted small">
                Struktur Organisasi Periode Kepengurusan
            </p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>

