<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AION - Intelligent Scheduling AI</title>
     <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #000;
            color: #fff;
            overflow-x: hidden;
        }

        .hero-section {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            background: #000;
        }

        #canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .grid-overlay {
            position: absolute;
            inset: 0;
            opacity: 0.1;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(0, 255, 255, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .content-wrapper {
            position: relative;
            height: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3rem;
            z-index: 10;
        }

        .text-content {
            width: 50%;
            transition: opacity 0.3s ease;
        }

        .logo {
            font-size: 6rem;
            font-weight: bold;
            color: #fff;
            letter-spacing: 0.1em;
            margin-bottom: 1.5rem;
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.6), 0 0 40px rgba(0, 255, 255, 0.3);
        }

        .divider {
            height: 1px;
            width: 8rem;
            background: linear-gradient(to right, #00ffff, transparent);
            margin-bottom: 1.5rem;
        }

        .subtitle {
            font-size: 2rem;
            color: #a0f0ff;
            font-weight: 300;
            letter-spacing: 0.05em;
            margin-bottom: 1.5rem;
            text-shadow: 0 0 15px rgba(0, 255, 255, 0.4);
        }

        .description {
            font-size: 1.25rem;
            color: #d1d5db;
            max-width: 40rem;
            margin-bottom: 2.5rem;
            line-height: 1.8;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }

        .description strong {
            font-weight: 700;
        }

        .cta-button {
            position: relative;
            display: inline-block;
            padding: 1rem 2rem;
            border: 2px solid #00ffff;
            border-radius: 9999px;
            color: #00ffff;
            font-weight: 600;
            letter-spacing: 0.1em;
            background: rgba(0, 255, 255, 0.05);
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
            cursor: pointer;
            overflow: hidden;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .cta-button:hover {
            border-color: #5ffbff;
            box-shadow: 0 0 40px rgba(0, 255, 255, 0.4);
            transform: translateY(-2px);
        }

        .logo-3d-container {
            position: relative;
            width: 26rem;
            height: 26rem;
            flex-shrink: 0;
            transition: opacity 0.3s ease;
            perspective: 1000px;
        }

        .ambient-glow {
            position: absolute;
            inset: -2rem;
            background: radial-gradient(circle, rgba(0, 255, 255, 0.3), transparent 70%);
            filter: blur(40px);
            animation: pulse-glow 3s ease-in-out infinite;
        }

        @keyframes pulse-glow {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.1); }
        }

        .letter-a {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 12rem;
            height: 14rem;
            z-index: 10;
        }

        .letter-a svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 0 20px rgba(0, 255, 255, 0.8))
                    drop-shadow(0 0 40px rgba(0, 255, 255, 0.4));
        }

        .orbit-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            border: 3px solid transparent;
            border-radius: 50%;
            transform-style: preserve-3d;
        }

        .orbit-ring-1 {
            width: 24rem;
            height: 24rem;
            margin: -12rem 0 0 -12rem;
            border-image: linear-gradient(90deg, #00ffff, #00ccff, #00ffff) 1;
            animation: orbit-rotate-1 8s linear infinite;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.5), inset 0 0 20px rgba(0, 255, 255, 0.3);
        }

        .orbit-ring-2 {
            width: 26rem;
            height: 26rem;
            margin: -13rem 0 0 -13rem;
            border-image: linear-gradient(180deg, #00ffff, #0099ff, #00ffff) 1;
            animation: orbit-rotate-2 12s linear infinite reverse;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.4), inset 0 0 15px rgba(0, 255, 255, 0.2);
            border-width: 2px;
        }

        .orbit-ring-3 {
            width: 22rem;
            height: 22rem;
            margin: -11rem 0 0 -11rem;
            border-image: linear-gradient(270deg, #00ffff, #00aaff, #00ffff) 1;
            animation: orbit-rotate-3 10s linear infinite;
            box-shadow: 0 0 18px rgba(0, 255, 255, 0.4);
            border-width: 2px;
        }

        @keyframes orbit-rotate-1 {
            0% { transform: rotateZ(0deg) rotateY(70deg); }
            100% { transform: rotateZ(360deg) rotateY(70deg); }
        }

        @keyframes orbit-rotate-2 {
            0% { transform: rotateZ(0deg) rotateY(-60deg) rotateX(20deg); }
            100% { transform: rotateZ(360deg) rotateY(-60deg) rotateX(20deg); }
        }

        @keyframes orbit-rotate-3 {
            0% { transform: rotateZ(0deg) rotateY(50deg) rotateX(-15deg); }
            100% { transform: rotateZ(360deg) rotateY(50deg) rotateX(-15deg); }
        }

        .orbit-particle {
            position: absolute;
            width: 12px;
            height: 12px;
            background: #00ffff;
            border-radius: 50%;
            box-shadow: 0 0 15px #00ffff, 0 0 30px #00ffff;
            animation: particle-orbit 8s linear infinite;
        }

        .orbit-particle-1 {
            top: 50%;
            left: 100%;
            margin: -6px 0 0 -6px;
        }

        .orbit-particle-2 {
            top: 0;
            left: 50%;
            margin: -6px 0 0 -6px;
            animation-delay: -2s;
        }

        @keyframes particle-orbit {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }

        .energy-particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #00ffff;
            border-radius: 50%;
            box-shadow: 0 0 10px #00ffff;
            opacity: 0.6;
            animation: float-particle 4s ease-in-out infinite;
        }

        @keyframes float-particle {
            0%, 100% { transform: translate(0, 0); }
            25% { transform: translate(20px, -20px); }
            50% { transform: translate(-10px, -40px); }
            75% { transform: translate(-20px, -20px); }
        }

        .crack-line {
            position: absolute;
            width: 3px;
            background: linear-gradient(180deg, transparent, #00ffff, transparent);
            box-shadow: 0 0 15px #00ffff;
            top: 50%;
            left: 50%;
            transform-origin: center;
            opacity: 0;
            transition: opacity 0.3s ease, height 0.3s ease;
            z-index: 20;
        }

        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            width: 24px;
            height: 40px;
            border: 2px solid rgba(0, 255, 255, 0.5);
            border-radius: 20px;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding-top: 8px;
            animation: bounce 2s ease-in-out infinite;
        }

        .scroll-dot {
            width: 4px;
            height: 8px;
            background: #00ffff;
            border-radius: 2px;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 255, 255, 0.1);
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: radial-gradient(circle, #00ffff, #00cccc);
            border-radius: 50%;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #000;
            font-size: 1.25rem;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
            letter-spacing: 0.1em;
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
        }

        .language-switcher {
            display: flex;
            gap: 0.5rem;
            background: rgba(0, 255, 255, 0.05);
            padding: 0.5rem;
            border-radius: 25px;
            border: 1px solid rgba(0, 255, 255, 0.2);
        }

        .lang-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 20px;
            background: transparent;
            color: #a0f0ff;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            letter-spacing: 0.05em;
        }

        .lang-btn:hover {
            color: #00ffff;
        }

        .lang-btn.active {
            background: rgba(0, 255, 255, 0.2);
            color: #00ffff;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }
            .logo-text {
                font-size: 1.25rem;
            }
            .lang-btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }
            .content-wrapper {
                padding: 0 2rem;
                flex-direction: column;
                justify-content: center;
            }
            .text-content {
                width: 100%;
                text-align: center;
            }
            .logo { font-size: 4rem; }
            .subtitle { font-size: 1.5rem; }
            .description { font-size: 1rem; }
            .divider { margin: 1.5rem auto; }
            .logo-3d-container {
                width: 20rem;
                height: 20rem;
            }
            .letter-a {
                width: 9rem;
                height: 11rem;
            }
            .orbit-ring-1 {
                width: 18rem;
                height: 18rem;
                margin: -9rem 0 0 -9rem;
            }
            .orbit-ring-2 {
                width: 20rem;
                height: 20rem;
                margin: -10rem 0 0 -10rem;
            }
            .orbit-ring-3 {
                width: 16rem;
                height: 16rem;
                margin: -8rem 0 0 -8rem;
            }
        }

        .second-section {
            position: relative;
            min-height: 100vh;
            background: #000;
            padding: 6rem 2rem;
            overflow: hidden;
        }

        .second-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #00ffff, transparent);
            opacity: 0.5;
        }

        .section-content {
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        .section-title {
            font-size: 3.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 3rem;
            color: #fff;
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
            letter-spacing: 0.05em;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }

        .feature-card {
            background: rgba(0, 255, 255, 0.03);
            border: 1px solid rgba(0, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2.5rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #00ffff, transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            border-color: #00ffff;
            box-shadow: 0 10px 40px rgba(0, 255, 255, 0.3);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: radial-gradient(circle, rgba(0, 255, 255, 0.3), rgba(0, 255, 255, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.4);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #00ffff;
            margin-bottom: 1rem;
            letter-spacing: 0.05em;
        }

        .feature-description {
            color: #b0b0b0;
            line-height: 1.8;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 2.5rem;
            }
            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="#" class="navbar-logo">
            <div class="logo-icon">A</div>
            <span class="logo-text">AION</span>
        </a>
        <div class="language-switcher">
            <button class="lang-btn active" data-lang="id">ID</button>
            <button class="lang-btn" data-lang="en">EN</button>
        </div>
    </nav>
    <div class="hero-section">
        <canvas id="canvas"></canvas>
        <div class="grid-overlay"></div>

        <div class="content-wrapper">
            <!-- Left Side - Text Content -->
            <div class="text-content" id="textContent">
                <h1 class="logo">AION</h1>
                <div class="divider"></div>
                <h2 class="subtitle" data-i18n="subtitle">Intelligent Scheduling AI</h2>
                <p class="description">
                    <strong data-i18n="description">Mengelola waktu dengan kecerdasan buatan dan otomatisasi cerdas</strong>
                </p>
                <a href="#" class="cta-button" data-i18n="cta">MULAI SEKARANG</a>
            </div>

            <!-- Right Side - 3D Logo with Orbits -->
            <div class="logo-3d-container" id="logoContainer">
                <!-- Ambient glow -->
                <div class="ambient-glow"></div>

                <!-- Letter A -->
                <div class="letter-a">
                    <svg viewBox="0 0 200 240" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="aGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#00ffff;stop-opacity:1" />
                                <stop offset="50%" style="stop-color:#00ccff;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#0099ff;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <!-- Outer A -->
                        <path d="M 100 20 L 180 220 L 140 220 L 125 180 L 75 180 L 60 220 L 20 220 Z"
                              fill="url(#aGradient)" stroke="#00ffff" stroke-width="2"/>
                        <!-- Inner triangle cutout -->
                        <path d="M 100 80 L 115 120 L 85 120 Z" fill="#000"/>
                        <!-- Horizontal bar -->
                        <rect x="75" y="140" width="50" height="20" fill="#000"/>
                    </svg>
                </div>

                <!-- Orbital rings -->
                <div class="orbit-ring orbit-ring-1">
                    <div class="orbit-particle orbit-particle-1"></div>
                </div>
                <div class="orbit-ring orbit-ring-2">
                    <div class="orbit-particle orbit-particle-2"></div>
                </div>
                <div class="orbit-ring orbit-ring-3"></div>

                <!-- Floating energy particles -->
                <div class="energy-particle" style="top: 20%; left: 30%; animation-delay: 0s;"></div>
                <div class="energy-particle" style="top: 70%; left: 20%; animation-delay: 1s;"></div>
                <div class="energy-particle" style="top: 40%; right: 25%; animation-delay: 2s;"></div>
                <div class="energy-particle" style="bottom: 30%; right: 30%; animation-delay: 1.5s;"></div>
                <div class="energy-particle" style="top: 60%; left: 70%; animation-delay: 0.5s;"></div>

                <!-- Crack lines for explosion -->
                <div id="cracks"></div>
            </div>
        </div>

        <div class="scroll-indicator">
            <div class="scroll-dot"></div>
        </div>
    </div>

    <!-- Second Section - Features -->
    <section class="second-section">
        <div class="section-content">
            <h2 class="section-title" data-i18n="features-title">Fitur Unggulan</h2>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🤖</div>
                    <h3 class="feature-title" data-i18n="feature1-title">AI-Powered Scheduling</h3>
                    <p class="feature-description" data-i18n="feature1-desc">
                        Sistem penjadwalan otomatis yang mempelajari pola dan preferensi Anda untuk mengoptimalkan waktu secara cerdas.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3 class="feature-title" data-i18n="feature2-title">Smart Automation</h3>
                    <p class="feature-description" data-i18n="feature2-desc">
                        Otomatisasi tugas berulang dan pengingat cerdas yang beradaptasi dengan rutinitas harian Anda.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3 class="feature-title" data-i18n="feature3-title">Advanced Analytics</h3>
                    <p class="feature-description" data-i18n="feature3-desc">
                        Analisis mendalam tentang produktivitas dan penggunaan waktu dengan visualisasi data yang intuitif.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🔄</div>
                    <h3 class="feature-title" data-i18n="feature4-title">Real-time Sync</h3>
                    <p class="feature-description" data-i18n="feature4-desc">
                        Sinkronisasi real-time di semua perangkat Anda untuk akses jadwal kapan saja, di mana saja.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3 class="feature-title" data-i18n="feature5-title">Goal Tracking</h3>
                    <p class="feature-description" data-i18n="feature5-desc">
                        Pelacakan tujuan otomatis dengan rekomendasi AI untuk mencapai target Anda lebih efisien.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3 class="feature-title" data-i18n="feature6-title">Secure & Private</h3>
                    <p class="feature-description" data-i18n="feature6-desc">
                        Enkripsi end-to-end dan keamanan tingkat enterprise untuk melindungi data pribadi Anda.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script>



        // Translations
        const translations = {
            id: {
                subtitle: 'Intelligent Scheduling AI',
                description: 'Mengelola waktu dengan kecerdasan buatan dan otomatisasi cerdas',
                cta: 'MULAI SEKARANG',
                'features-title': 'Fitur Unggulan',
                'feature1-title': 'AI-Powered Scheduling',
                'feature1-desc': 'Sistem penjadwalan otomatis yang mempelajari pola dan preferensi Anda untuk mengoptimalkan waktu secara cerdas.',
                'feature2-title': 'Smart Automation',
                'feature2-desc': 'Otomatisasi tugas berulang dan pengingat cerdas yang beradaptasi dengan rutinitas harian Anda.',
                'feature3-title': 'Advanced Analytics',
                'feature3-desc': 'Analisis mendalam tentang produktivitas dan penggunaan waktu dengan visualisasi data yang intuitif.',
                'feature4-title': 'Real-time Sync',
                'feature4-desc': 'Sinkronisasi real-time di semua perangkat Anda untuk akses jadwal kapan saja, di mana saja.',
                'feature5-title': 'Goal Tracking',
                'feature5-desc': 'Pelacakan tujuan otomatis dengan rekomendasi AI untuk mencapai target Anda lebih efisien.',
                'feature6-title': 'Secure & Private',
                'feature6-desc': 'Enkripsi end-to-end dan keamanan tingkat enterprise untuk melindungi data pribadi Anda.'
            },
            en: {
                subtitle: 'Intelligent Scheduling AI',
                description: 'Manage time with artificial intelligence and smart automation',
                cta: 'GET STARTED',
                'features-title': 'Key Features',
                'feature1-title': 'AI-Powered Scheduling',
                'feature1-desc': 'Automated scheduling system that learns your patterns and preferences to optimize time intelligently.',
                'feature2-title': 'Smart Automation',
                'feature2-desc': 'Automate repetitive tasks and smart reminders that adapt to your daily routine.',
                'feature3-title': 'Advanced Analytics',
                'feature3-desc': 'Deep insights into productivity and time usage with intuitive data visualization.',
                'feature4-title': 'Real-time Sync',
                'feature4-desc': 'Real-time synchronization across all your devices for schedule access anytime, anywhere.',
                'feature5-title': 'Goal Tracking',
                'feature5-desc': 'Automatic goal tracking with AI recommendations to achieve your targets more efficiently.',
                'feature6-title': 'Secure & Private',
                'feature6-desc': 'End-to-end encryption and enterprise-grade security to protect your personal data.'
            }
        };

        let currentLang = 'id';

        // Language switcher
        const langButtons = document.querySelectorAll('.lang-btn');
        langButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const lang = btn.dataset.lang;
                if (lang === currentLang) return;

                // Update active state
                langButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                // Update language
                currentLang = lang;
                updateLanguage();
            });
        });

        function updateLanguage() {
            const elements = document.querySelectorAll('[data-i18n]');
            elements.forEach(el => {
                const key = el.dataset.i18n;
                if (translations[currentLang][key]) {
                    el.textContent = translations[currentLang][key];
                }
            });
        }

        // Canvas setup
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        // Background particles
        const bgParticles = Array.from({ length: 80 }, () => ({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            size: Math.random() * 2 + 0.5,
            speedX: (Math.random() - 0.5) * 0.3,
            speedY: (Math.random() - 0.5) * 0.3,
            opacity: Math.random() * 0.5 + 0.2
        }));

        let explosionParticles = [];
        let hasExploded = false;

        // Generate grid lines for globe
        const gridLinesContainer = document.getElementById('gridLines');
        for (let i = 0; i < 8; i++) {
            const line = document.createElement('div');
            line.className = 'grid-line';
            line.style.cssText = `
                left: 50%;
                top: 50%;
                width: 100%;
                height: ${(i + 1) * 12}%;
                transform: translate(-50%, -50%);
            `;
            gridLinesContainer.appendChild(line);
        }

        // Generate data points
        const dataPointsContainer = document.getElementById('dataPoints');
        for (let i = 0; i < 20; i++) {
            const point = document.createElement('div');
            point.className = 'data-point';
            point.style.cssText = `
                left: ${Math.random() * 80 + 10}%;
                top: ${Math.random() * 80 + 10}%;
                animation-delay: ${i * 0.1}s;
            `;
            dataPointsContainer.appendChild(point);
        }

        // Generate crack lines
        const cracksContainer = document.getElementById('cracks');
        for (let i = 0; i < 12; i++) {
            const crack = document.createElement('div');
            crack.className = 'crack-line';
            crack.style.transform = `translate(-50%, -50%) rotate(${i * 30}deg)`;
            cracksContainer.appendChild(crack);
        }

        // Animation loop
        function animate() {
            ctx.fillStyle = '#000000';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            // Draw background particles
            bgParticles.forEach(p => {
                p.x += p.speedX;
                p.y += p.speedY;

                if (p.x < 0 || p.x > canvas.width) p.speedX *= -1;
                if (p.y < 0 || p.y > canvas.height) p.speedY *= -1;

                ctx.beginPath();
                ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(0, 255, 255, ${p.opacity})`;
                ctx.shadowBlur = 10;
                ctx.shadowColor = '#00ffff';
                ctx.fill();
                ctx.shadowBlur = 0;
            });

            // Draw explosion particles
            explosionParticles.forEach((p, index) => {
                p.x += p.vx;
                p.y += p.vy;
                p.vy += 0.05;
                p.opacity -= 0.01;
                p.size *= 0.98;

                if (p.opacity <= 0 || p.size <= 0.1) {
                    explosionParticles.splice(index, 1);
                    return;
                }

                ctx.beginPath();
                ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(0, 255, 255, ${p.opacity})`;
                ctx.shadowBlur = 15;
                ctx.shadowColor = '#00ffff';
                ctx.fill();
                ctx.shadowBlur = 0;
            });

            requestAnimationFrame(animate);
        }

        animate();

        // Scroll handling
        let scrollY = 0;
        window.addEventListener('scroll', () => {
            scrollY = window.scrollY;

            const orbOpacity = Math.max(0, 1 - scrollY / 200);
            const crackProgress = Math.min(1, scrollY / 150);
            const textOpacity = Math.max(0, 1 - scrollY / 300);

            // Update text opacity
            document.getElementById('textContent').style.opacity = textOpacity;
            document.getElementById('globeContainer').style.opacity = orbOpacity;

            // Update glow layers scale
            const glow1 = document.getElementById('glow1');
            const glow2 = document.getElementById('glow2');
            const sphere = document.getElementById('sphere');

            glow1.style.transform = `scale(${1 + crackProgress * 0.3})`;
            glow2.style.transform = `scale(${1 + crackProgress * 0.2})`;
            sphere.style.transform = `scale(${1 + crackProgress * 0.1})`;

            // Update crack lines
            const cracks = cracksContainer.querySelectorAll('.crack-line');
            cracks.forEach(crack => {
                crack.style.height = `${crackProgress * 180}px`;
                crack.style.opacity = crackProgress;
            });

            // Create explosion
            if (scrollY > 150 && !hasExploded) {
                hasExploded = true;
                const globeContainer = document.getElementById('globeContainer');
                const globeRect = globeContainer.getBoundingClientRect();
                const centerX = globeRect.left + globeRect.width / 2;
                const centerY = globeRect.top + globeRect.height / 2;

                for (let i = 0; i < 400; i++) {
                    const angle = Math.random() * Math.PI * 2;
                    const speed = Math.random() * 5 + 2;
                    explosionParticles.push({
                        x: centerX,
                        y: centerY,
                        vx: Math.cos(angle) * speed,
                        vy: Math.sin(angle) * speed,
                        size: Math.random() * 3 + 1,
                        opacity: 1
                    });
                }
            }
        });

        // Resize handling
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });


    </script>
</body>
</html>
