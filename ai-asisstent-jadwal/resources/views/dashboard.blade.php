<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abang AI - Asisten AI Cerdas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            color: #1a1a1a;
            overflow-x: hidden;
        }

        /* Navbar - Tipis */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: #E31E24;
            box-shadow: 0 2px 10px rgba(227, 30, 36, 0.1);
            height: 60px;
        }

        .navbar-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .logo-box {
            width: 36px;
            height: 36px;
            background: #ffffff;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #E31E24;
            font-size: 1.1rem;
        }

        .logo-text {
            font-size: 1.3rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.02em;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-link {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: opacity 0.3s;
        }

        .nav-link:hover {
            opacity: 0.8;
        }

        .nav-buttons {
            display: flex;
            gap: 0.75rem;
        }

        .btn-login {
            padding: 0.5rem 1.5rem;
            background: transparent;
            border: 2px solid #ffffff;
            border-radius: 8px;
            color: #ffffff;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-login:hover {
            background: #ffffff;
            color: #E31E24;
        }

        .btn-register {
            padding: 0.5rem 1.5rem;
            background: #ffffff;
            border: 2px solid #ffffff;
            border-radius: 8px;
            color: #E31E24;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-register:hover {
            background: transparent;
            color: #ffffff;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #E31E24 0%, #C41E3A 100%);
            padding-top: 60px;
            overflow: hidden;
        }

        .hero-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.05;
            background-image:
                repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.1) 35px, rgba(255,255,255,.1) 70px);
        }

        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-text {
            color: #ffffff;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.95;
            margin-bottom: 2.5rem;
            line-height: 1.6;
            font-weight: 400;
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
        }

        .btn-primary {
            padding: 1rem 2rem;
            background: #ffffff;
            border: none;
            border-radius: 12px;
            color: #E31E24;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3);
        }

        .btn-secondary {
            padding: 1rem 2rem;
            background: transparent;
            border: 2px solid #ffffff;
            border-radius: 12px;
            color: #ffffff;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Hero Image/Illustration */
        .hero-visual {
            position: relative;
        }

        .hero-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .ai-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #E31E24, #C41E3A);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        .card-subtitle {
            font-size: 0.9rem;
            color: #666;
        }

        .chat-bubble {
            background: #f5f5f5;
            padding: 1.25rem;
            border-radius: 16px;
            margin-bottom: 1rem;
            color: #1a1a1a;
            line-height: 1.6;
        }

        .typing-indicator {
            display: flex;
            gap: 0.4rem;
            padding: 1rem;
        }

        .typing-dot {
            width: 10px;
            height: 10px;
            background: #E31E24;
            border-radius: 50%;
            animation: typing 1.4s ease-in-out infinite;
        }

        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }

        @keyframes typing {
            0%, 60%, 100% { transform: translateY(0); opacity: 0.5; }
            30% { transform: translateY(-10px); opacity: 1; }
        }

        /* Features Section */
        .features-section {
            padding: 6rem 2rem;
            background: #ffffff;
        }

        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 4rem;
        }

        .section-badge {
            display: inline-block;
            background: #FEE2E2;
            color: #E31E24;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.6;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .feature-card {
            background: #ffffff;
            border: 2px solid #f0f0f0;
            border-radius: 20px;
            padding: 2.5rem;
            transition: all 0.3s;
        }

        .feature-card:hover {
            border-color: #E31E24;
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(227, 30, 36, 0.1);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #E31E24, #C41E3A);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1rem;
        }

        .feature-description {
            color: #666;
            line-height: 1.7;
            font-size: 1rem;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #E31E24 0%, #C41E3A 100%);
            padding: 5rem 2rem;
            text-align: center;
            color: #ffffff;
        }

        .cta-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        .cta-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: transparent;
            border: none;
            color: #ffffff;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .navbar-content {
                padding: 0 1rem;
            }

            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero-content {
                grid-template-columns: 1fr;
                gap: 3rem;
                padding: 3rem 1rem;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .hero-visual {
                order: -1;
            }

            .section-title {
                font-size: 2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .cta-title {
                font-size: 2rem;
            }

            .nav-buttons {
                gap: 0.5rem;
            }

            .btn-login, .btn-register {
                padding: 0.4rem 1rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-content">
            <a href="/" class="navbar-logo">
                <div class="logo-box">AI</div>
                <span class="logo-text">Abang AI</span>
            </a>

            <div class="nav-links">
                <a href="#beranda" class="nav-link">Beranda</a>
                <a href="#fitur" class="nav-link">Fitur</a>
                <a href="#tentang" class="nav-link">Tentang</a>
            </div>

            <div class="nav-buttons">
                <a href="/login" class="btn-login">Masuk</a>
                <a href="/login" class="btn-register">Daftar</a>
            </div>

            <button class="mobile-menu-btn">☰</button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="beranda">
        <div class="hero-pattern"></div>
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">🚀 AI Terbaru 2026</div>
                <h1 class="hero-title">Asisten AI Cerdas untuk Kehidupan Anda</h1>
                <p class="hero-subtitle">
                    Abang AI siap membantu Anda mengelola jadwal, meningkatkan produktivitas,
                    dan menjawab pertanyaan dengan cepat dan akurat.
                </p>
                <div class="hero-cta">
                    <a href="/login" class="btn-primary">Mulai Sekarang</a>
                    <a href="#fitur" class="btn-secondary">Pelajari Lebih Lanjut</a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-card">
                    <div class="card-header">
                        <div class="ai-avatar">🤖</div>
                        <div>
                            <div class="card-title">Abang AI</div>
                            <div class="card-subtitle">Asisten Virtual Anda</div>
                        </div>
                    </div>
                    <div class="chat-bubble">
                        Halo! Saya Abang AI, siap membantu Anda. Apa yang bisa saya bantu hari ini?
                    </div>
                    <div class="typing-indicator">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="fitur">
        <div class="section-header">
            <div class="section-badge">Fitur Unggulan</div>
            <h2 class="section-title">Kenapa Memilih Abang AI?</h2>
            <p class="section-subtitle">
                Teknologi AI terdepan yang dirancang untuk memudahkan aktivitas sehari-hari Anda
            </p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🤖</div>
                <h3 class="feature-title">AI Cerdas</h3>
                <p class="feature-description">
                    Ditenagai oleh teknologi AI terbaru yang dapat memahami konteks
                    dan memberikan jawaban yang relevan dan akurat.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">📅</div>
                <h3 class="feature-title">Manajemen Jadwal</h3>
                <p class="feature-description">
                    Kelola jadwal harian Anda dengan mudah. Abang AI akan mengingatkan
                    tugas penting dan membantu mengatur waktu lebih efisien.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3 class="feature-title">Respon Cepat</h3>
                <p class="feature-description">
                    Dapatkan jawaban instan untuk berbagai pertanyaan Anda.
                    Abang AI siap membantu 24/7 tanpa henti.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3 class="feature-title">Personalisasi</h3>
                <p class="feature-description">
                    AI yang belajar dari preferensi Anda dan memberikan
                    rekomendasi yang disesuaikan dengan kebutuhan pribadi.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3 class="feature-title">Aman & Privat</h3>
                <p class="feature-description">
                    Data Anda dilindungi dengan enkripsi tingkat enterprise.
                    Privasi adalah prioritas utama kami.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3 class="feature-title">Multi-Platform</h3>
                <p class="feature-description">
                    Akses Abang AI dari mana saja - web, mobile, atau desktop.
                    Sinkronisasi otomatis di semua perangkat.
                </p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2 class="cta-title">Siap Mulai dengan Abang AI?</h2>
            <p class="cta-subtitle">
                Bergabunglah dengan ribuan pengguna yang sudah merasakan manfaat Abang AI
            </p>
            <a href="/login" class="btn-primary">Daftar Gratis Sekarang</a>
        </div>
    </section>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
