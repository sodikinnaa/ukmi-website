<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKM Arrahman - Unit Kegiatan Mahasiswa Islam Arrahman Teknokrat</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #4299e1;
            --secondary-blue: #206bc4;
            --dark-blue: #1e40af;
            --light-blue: #bfdbfe;
            --sky-blue: #87ceeb;
            --accent-gold: #f59f00;
            --accent-orange: #fd7e14;
            --text-dark: #1e293b;
            --text-gray: #64748b;
            --light-gray: #f1f5f9;
            --white: #ffffff;
            --black: #000000;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            background: var(--white);
        }

        /* Header/Navbar */
        .navbar {
            background: var(--white) !important;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--primary-blue) !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand img {
            height: 40px;
            width: auto;
        }

        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--primary-blue) !important;
        }

        .btn-daftar {
            background: var(--primary-blue);
            color: var(--white);
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            border: none;
            transition: background 0.3s;
        }

        .btn-daftar:hover {
            background: var(--secondary-blue);
            color: var(--white);
        }

        /* Hero Section */
        .hero-section {
            padding: 4rem 0;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 1.5rem;
            color: var(--primary-blue);
        }

        .hero-desc {
            font-size: 1.1rem;
            color: var(--text-gray);
            margin-bottom: 2rem;
            max-width: 700px;
        }

        .btn-gabung {
            background: var(--primary-blue);
            color: var(--white);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(66, 153, 225, 0.3);
        }

        .btn-gabung:hover {
            background: var(--secondary-blue);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(66, 153, 225, 0.4);
        }

        .banner-placeholder {
            background: linear-gradient(135deg, var(--sky-blue) 0%, var(--light-blue) 100%);
            border-radius: 12px;
            padding: 4rem 2rem;
            text-align: center;
            color: var(--text-dark);
            margin-top: 3rem;
            border: 2px dashed var(--primary-blue);
            transition: all 0.3s;
        }

        .banner-placeholder:hover {
            border-color: var(--accent-gold);
            box-shadow: 0 8px 25px rgba(66, 153, 225, 0.15);
        }

        /* Section Styles */
        .section {
            padding: 4rem 0;
        }

        .section-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            text-align: center;
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--accent-gold));
            border-radius: 2px;
        }

        .section-desc {
            color: var(--text-gray);
            font-size: 1rem;
            text-align: center;
            max-width: 700px;
            margin: 0 auto 3rem;
        }

        /* Feature Cards */
        .feature-card {
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            height: 100%;
            transition: transform 0.3s, box-shadow 0.3s;
            border-top: 4px solid var(--primary-blue);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(66, 153, 225, 0.2);
            border-top-color: var(--accent-gold);
        }

        .feature-card-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .feature-card-desc {
            color: var(--text-gray);
            line-height: 1.7;
        }

        /* Visi Misi Section */
        .visi-misi-container {
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 2px solid var(--light-blue);
        }

        .visi-misi-card {
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--white) 100%);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 4px 20px rgba(66, 153, 225, 0.1);
            height: 100%;
            border-left: 5px solid var(--primary-blue);
        }

        .visi-misi-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .visi-misi-title i {
            font-size: 1.8rem;
            color: var(--accent-gold);
        }

        .visi-misi-content {
            color: var(--text-dark);
            line-height: 1.8;
            font-size: 1rem;
        }

        .visi-misi-content ul {
            margin-top: 1rem;
            padding-left: 1.5rem;
        }

        .visi-misi-content li {
            margin-bottom: 0.75rem;
            color: var(--text-gray);
        }

        .visi-misi-content li::marker {
            color: var(--primary-blue);
        }

        /* Profile Cards */
        .profile-section {
            padding: 4rem 0;
        }

        .profile-card {
            text-align: center;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--light-blue), var(--white));
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid var(--primary-blue);
            transition: all 0.3s;
        }

        .profile-image:hover {
            border-color: var(--accent-gold);
            transform: scale(1.05);
        }

        .profile-image i {
            font-size: 3rem;
            color: var(--primary-blue);
        }

        .profile-name {
            font-weight: 600;
            color: var(--primary-blue);
            font-size: 1rem;
        }

        /* Activity Cards */
        .activity-card {
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            height: 100%;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            border-top: 4px solid var(--primary-blue);
        }

        .activity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(32, 107, 196, 0.2);
            border-top-color: var(--accent-gold);
        }

        .activity-icon {
            font-size: 3rem;
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            transition: all 0.3s;
        }

        .activity-card:hover .activity-icon {
            color: var(--secondary-blue);
            transform: scale(1.1);
        }

        .activity-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .activity-desc {
            color: var(--text-gray);
            line-height: 1.7;
        }

        /* Gallery Section */
        .gallery-section {
            padding: 4rem 0;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        }

        .gallery-item {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
            aspect-ratio: 16/9;
            background: var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed var(--primary-blue);
            transition: all 0.3s;
            cursor: pointer;
        }

        .gallery-item:hover {
            border-color: var(--accent-gold);
            transform: scale(1.03);
            box-shadow: 0 8px 30px rgba(66, 153, 225, 0.2);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-placeholder {
            color: var(--text-gray);
            text-align: center;
        }

        /* Testimonial Cards */
        .testimonial-section {
            padding: 4rem 0;
        }

        .testimonial-card {
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            height: 100%;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .testimonial-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--light-blue), var(--white));
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid var(--primary-blue);
            transition: all 0.3s;
        }

        .testimonial-card:hover .testimonial-avatar {
            border-color: var(--accent-gold);
            transform: scale(1.1);
        }

        .testimonial-avatar i {
            font-size: 2rem;
            color: var(--primary-blue);
        }

        .testimonial-quote {
            color: var(--text-gray);
            font-style: italic;
            line-height: 1.7;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .testimonial-quote::before {
            content: '"';
            font-size: 3rem;
            color: var(--primary-blue);
            opacity: 0.2;
            position: absolute;
            top: -20px;
            left: -10px;
        }

        .testimonial-name {
            font-weight: 700;
            color: var(--primary-blue);
            font-size: 1.1rem;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: var(--white);
            padding: 3rem 0 2rem;
        }

        .footer-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .footer-link {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
            transition: color 0.3s;
        }

        .footer-link:hover {
            color: var(--white);
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            margin-right: 0.5rem;
            transition: background 0.3s;
        }

        .social-icon:hover {
            background: var(--accent-gold);
            color: var(--white);
            transform: translateY(-3px);
        }

        .footer-copyright {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.7);
        }

        /* Additional Visual Enhancements */
        .hero-title {
            color: var(--primary-blue);
        }

        .section {
            position: relative;
        }

        .section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-blue), transparent);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .profile-image {
                width: 120px;
                height: 120px;
            }

            .navbar-brand span {
                display: none;
            }

            .visi-misi-container {
                margin-top: 3rem;
                padding-top: 2rem;
            }

            .visi-misi-card {
                padding: 2rem;
            }

            .visi-misi-title {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/59/Logo_UKMI.png" alt="Logo UKM Arrahman">
                <span>UKM Arrahman</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Portofolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pengurus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                </ul>
                <button class="btn btn-daftar">Daftar UKM</button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="hero-title">Perkenalan Unit Kegiatan Mahasiswa Islam Arrahman Teknokrat</h1>
                    <p class="hero-desc">
                        Mewujudkan generasi muda yang berakhlak mulia, berilmu, dan berdaya saing tinggi melalui pengembangan diri di bidang keislaman dan teknologi.
                    </p>
                    <button class="btn btn-gabung">Gabung Sekarang</button>
                    
                    <div class="banner-placeholder">
                        <i class="bi bi-image" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                        <p style="margin: 0;">Illustration placeholder or wide banner image</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Tentang UKM Arrahman</h2>
            <p class="section-desc">
                Unit Kegiatan Mahasiswa Islam Arrahman merupakan wadah pengembangan diri bagi mahasiswa dalam mengintegrasikan nilai-nilai keislaman dengan penguasaan ilmu pengetahuan dan teknologi.
            </p>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <h3 class="feature-card-title">Pembinaan Karakter</h3>
                        <p class="feature-card-desc">
                            Membentuk karakter mahasiswa yang berakhlak mulia, memiliki integritas tinggi, dan siap menjadi pemimpin masa depan yang bertanggung jawab.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <h3 class="feature-card-title">Pengembangan Spiritual</h3>
                        <p class="feature-card-desc">
                            Menguatkan aspek spiritual melalui kegiatan keislaman yang relevan dengan kehidupan modern dan perkembangan zaman.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <h3 class="feature-card-title">Penguasaan Ilmu & Teknologi</h3>
                        <p class="feature-card-desc">
                            Meningkatkan kompetensi di bidang teknologi dan ilmu pengetahuan untuk menghadapi tantangan era digital.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Visi Misi Section -->
            <div class="visi-misi-container">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="visi-misi-card">
                            <h3 class="visi-misi-title">
                                <i class="bi bi-eye-fill"></i>
                                Visi
                            </h3>
                            <div class="visi-misi-content">
                                <p>
                                    Menjadi wadah pengembangan diri mahasiswa yang unggul dalam mengintegrasikan nilai-nilai keislaman dengan penguasaan ilmu pengetahuan dan teknologi, serta membentuk generasi muda yang berakhlak mulia, berilmu, dan berdaya saing tinggi.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="visi-misi-card">
                            <h3 class="visi-misi-title">
                                <i class="bi bi-bullseye"></i>
                                Misi
                            </h3>
                            <div class="visi-misi-content">
                                <ul>
                                    <li>Menyelenggarakan kegiatan pembinaan karakter dan akhlak mulia berdasarkan nilai-nilai Islam</li>
                                    <li>Mengembangkan kompetensi mahasiswa di bidang ilmu pengetahuan dan teknologi</li>
                                    <li>Meningkatkan kualitas spiritual dan pemahaman keislaman yang relevan dengan zaman</li>
                                    <li>Membangun jaringan dan sinergi dengan berbagai pihak untuk pengembangan organisasi</li>
                                    <li>Menyelenggarakan program-program yang mendukung pengembangan soft skills dan leadership</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Management Section -->
    <section class="profile-section">
        <div class="container">
            <h2 class="section-title">Pengurus Inti</h2>
            
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="profile-card">
                        <div class="profile-image">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <p class="profile-name">Ketua</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="profile-card">
                        <div class="profile-image">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <p class="profile-name">Wakil Ketua</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="profile-card">
                        <div class="profile-image">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <p class="profile-name">Sekretaris</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="profile-card">
                        <div class="profile-image">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <p class="profile-name">Bendahara</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Activities Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Program Kegiatan</h2>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="activity-card">
                        <div class="activity-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h3 class="activity-title">Ukhuwah</h3>
                        <p class="activity-desc">
                            Membangun persaudaraan yang kuat antar anggota melalui kegiatan bersama yang mempererat tali silaturahmi.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="activity-card">
                        <div class="activity-icon">
                            <i class="bi bi-diagram-3-fill"></i>
                        </div>
                        <h3 class="activity-title">Sinergi</h3>
                        <p class="activity-desc">
                            Menciptakan kolaborasi yang efektif dalam berbagai program untuk mencapai tujuan bersama secara optimal.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="activity-card">
                        <div class="activity-icon">
                            <i class="bi bi-book-fill"></i>
                        </div>
                        <h3 class="activity-title">Berlandaskan Islam</h3>
                        <p class="activity-desc">
                            Semua kegiatan dan program dilandasi oleh nilai-nilai Islam yang rahmatan lil alamin.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Activity Gallery Section -->
    <section class="gallery-section">
        <div class="container">
            <h2 class="section-title">Galeri Kegiatan</h2>
            <p class="section-desc">
                Lihat momen-momen berharga dan karya-karya dari berbagai kegiatan yang telah kami laksanakan.
            </p>
            
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="gallery-item">
                        <div class="gallery-placeholder">
                            <i class="bi bi-image" style="font-size: 2rem;"></i>
                            <p style="margin-top: 0.5rem; font-size: 0.9rem;">Image Placeholder</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gallery-item">
                        <div class="gallery-placeholder">
                            <i class="bi bi-image" style="font-size: 2rem;"></i>
                            <p style="margin-top: 0.5rem; font-size: 0.9rem;">Image Placeholder</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gallery-item">
                        <div class="gallery-placeholder">
                            <i class="bi bi-image" style="font-size: 2rem;"></i>
                            <p style="margin-top: 0.5rem; font-size: 0.9rem;">Image Placeholder</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gallery-item">
                        <div class="gallery-placeholder">
                            <i class="bi bi-image" style="font-size: 2rem;"></i>
                            <p style="margin-top: 0.5rem; font-size: 0.9rem;">Image Placeholder</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gallery-item">
                        <div class="gallery-placeholder">
                            <i class="bi bi-image" style="font-size: 2rem;"></i>
                            <p style="margin-top: 0.5rem; font-size: 0.9rem;">Image Placeholder</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gallery-item">
                        <div class="gallery-placeholder">
                            <i class="bi bi-image" style="font-size: 2rem;"></i>
                            <p style="margin-top: 0.5rem; font-size: 0.9rem;">Image Placeholder</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonial-section">
        <div class="container">
            <h2 class="section-title">Apa Kata Mereka?</h2>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <p class="testimonial-quote">
                            UKM Arrahman telah memberikan pengalaman yang sangat berharga dalam pengembangan diri saya, baik dari segi spiritual maupun akademik.
                        </p>
                        <p class="testimonial-name">Nama Mahasiswa 1</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <p class="testimonial-quote">
                            Melalui berbagai kegiatan di UKM Arrahman, saya belajar banyak tentang kepemimpinan dan kerja sama tim yang efektif.
                        </p>
                        <p class="testimonial-name">Nama Mahasiswa 2</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <p class="testimonial-quote">
                            UKM Arrahman adalah tempat terbaik untuk mengembangkan potensi diri sambil tetap menjaga nilai-nilai keislaman.
                        </p>
                        <p class="testimonial-name">Nama Mahasiswa 3</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h4 class="footer-title">Kontak</h4>
                    <a href="mailto:info@ukmarrahman.com" class="footer-link">
                        <i class="bi bi-envelope me-2"></i>info@ukmarrahman.com
                    </a>
                    <a href="tel:+62211234567" class="footer-link">
                        <i class="bi bi-telephone me-2"></i>(021) 123-4567
                    </a>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h4 class="footer-title">Alamat UKM</h4>
                    <p class="footer-link" style="margin-bottom: 0.5rem;">
                        <i class="bi bi-geo-alt me-2"></i>Jl. Raya Kampus No 123
                    </p>
                    <p class="footer-link" style="margin-bottom: 0;">
                        Bandar Lampung, Indonesia
                    </p>
                </div>
                <div class="col-md-4">
                    <h4 class="footer-title">Sosial Media</h4>
                    <div>
                        <a href="#" class="social-icon">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bi bi-youtube"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <p style="margin: 0;">© 2023 UKM Arrahman. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

