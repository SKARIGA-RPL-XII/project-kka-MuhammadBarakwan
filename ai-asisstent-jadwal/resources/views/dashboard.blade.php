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
            background: #0a0a0a;
            color: #ffffff;
            overflow-x: hidden;
        }

        .hero-section {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a0000 100%);
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
            opacity: 0.05;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255, 0, 0, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 0, 0, 0.1) 1px, transparent 1px);
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
            color: #ffffff;
            letter-spacing: 0.1em;
            margin-bottom: 1.5rem;
            text-shadow: 0 0 20px rgba(255, 0, 0, 0.6), 0 0 40px rgba(255, 0, 0, 0.3);
        }

        .divider {
            height: 2px;
            width: 8rem;
            background: linear-gradient(to right, #ff0000, transparent);
            margin-bottom: 1.5rem;
        }

        .subtitle {
            font-size: 2rem;
            color: #ffcccc;
            font-weight: 300;
            letter-spacing: 0.05em;
            margin-bottom: 1.5rem;
            text-shadow: 0 0 15px rgba(255, 0, 0, 0.4);
        }

        .description {
            font-size: 1.25rem;
            color: #d1d5db;
            max-width: 40rem;
            margin-bottom: 2.5rem;
            line-height: 1.8;
        }

        .description strong {
            font-weight: 700;
            color: #ffffff;
        }

        .cta-button {
            position: relative;
            display: inline-block;
            padding: 1rem 2rem;
            border: 2px solid #ff0000;
            border-radius: 9999px;
            color: #ffffff;
            font-weight: 600;
            letter-spacing: 0.1em;
            background: rgba(255, 0, 0, 0.1);
            box-shadow: 0 0 30px rgba(255, 0, 0, 0.3);
            cursor: pointer;
            overflow: hidden;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .cta-button:hover {
            background: rgba(255, 0, 0, 0.2);
            box-shadow: 0 0 40px rgba(255, 0, 0, 0.5);
            transform: translateY(-2px);
        }

        .logo-3d-container {
            position: relative;
            width: 26rem;
            height: 26rem;
            flex-shrink: 0;
            transition: opacity 0.3s ease;
        }

        .ambient-glow {
            position: absolute;
            inset: -2rem;
            background: radial-gradient(circle, rgba(255, 0, 0, 0.3), transparent 70%);
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
            filter: drop-shadow(0 0 20px rgba(255, 0, 0, 0.8))
                    drop-shadow(0 0 40px rgba(255, 0, 0, 0.4));
        }

        .orbit-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            border: 2px solid #ff0000;
            border-radius: 50%;
            opacity: 0.6;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.4);
        }

        .orbit-ring-1 {
            width: 24rem;
            height: 24rem;
            margin: -12rem 0 0 -12rem;
            animation: spin 8s linear infinite;
        }

        .orbit-ring-2 {
            width: 20rem;
            height: 20rem;
            margin: -10rem 0 0 -10rem;
            animation: spin 12s linear infinite reverse;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .orbit-dot {
            position: absolute;
            width: 8px;
            height: 8px;
            background: #ff0000;
            border-radius: 50%;
            top: 0;
            left: 50%;
            margin-left: -4px;
            box-shadow: 0 0 15px #ff0000;
        }

        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            width: 24px;
            height: 40px;
            border: 2px solid rgba(255, 0, 0, 0.5);
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
            background: #ff0000;
            border-radius: 2px;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
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
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 0, 0, 0.2);
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
            background: radial-gradient(circle, #ff0000, #cc0000);
            border-radius: 50%;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #ffffff;
            font-size: 1.25rem;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 0.1em;
            text-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
        }

        .language-switcher {
            display: flex;
            gap: 0.5rem;
            background: rgba(255, 0, 0, 0.05);
            padding: 0.5rem;
            border-radius: 25px;
            border: 1px solid rgba(255, 0, 0, 0.2);
        }

        .lang-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 20px;
            background: transparent;
            color: #ffcccc;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            letter-spacing: 0.05em;
        }

        .lang-btn:hover {
            color: #ff0000;
        }

        .lang-btn.active {
            background: rgba(255, 0, 0, 0.2);
            color: #ff0000;
            box-shadow: 0 0 15px rgba(255, 0, 0, 0.3);
        }

        .second-section {
            position: relative;
            min-height: 100vh;
            background: #0a0a0a;
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
            background: linear-gradient(90deg, transparent, #ff0000, transparent);
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
            color: #ffffff;
            text-shadow: 0 0 20px rgba(255, 0, 0, 0.5);
            letter-spacing: 0.05em;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 0, 0, 0.2);
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
            background: linear-gradient(90deg, transparent, #ff0000, transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            border-color: #ff0000;
            box-shadow: 0 10px 40px rgba(255, 0, 0, 0.3);
            background: rgba(255, 0, 0, 0.05);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: radial-gradient(circle, rgba(255, 0, 0, 0.3), rgba(255, 0, 0, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.4);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #ff3333;
            margin-bottom: 1rem;
            letter-spacing: 0.05em;
        }

        .feature-description {
            color: #b0b0b0;
            line-height: 1.8;
            font-size: 1rem;
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
                width: 16rem;
                height: 16rem;
                margin: -8rem 0 0 -8rem;
            }
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
    <nav class="navbar">
        <a href="/" class="navbar-logo">
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
            <div class="text-content" id="textContent">
                <h1 class="logo">AION</h1>
                <div class="divider"></div>
                <h2 class="subtitle" data-i18n="subtitle">Intelligent Scheduling AI</h2>
                <p class="description">
                    <strong data-i18n="description">Mengelola waktu dengan kecerdasan buatan dan otomatisasi cerdas</strong>
                </p>
                <a href="/chat" class="cta-button" data-i18n="cta">MULAI SEKARANG</a>
            </div>

            <div class="logo-3d-container" id="logoContainer">
                <div class="ambient-glow"></div>

                <div class="letter-a">
                    <svg viewBox="0 0 200 240" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="aGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#ff0000;stop-opacity:1" />
                                <stop offset="50%" style="stop-color:#cc0000;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#990000;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <path d="M 100 20 L 180 220 L 140 220 L 125 180 L 75 180 L 60 220 L 20 220 Z"
                              fill="url(#aGradient)" stroke="#ff0000" stroke-width="2"/>
                        <path d="M 100 80 L 115 120 L 85 120 Z" fill="#0a0a0a"/>
                        <rect x="75" y="140" width="50" height="20" fill="#0a0a0a"/>
                    </svg>
                </div>

                <div class="orbit-ring orbit-ring-1">
                    <div class="orbit-dot"></div>
                </div>
                <div class="orbit-ring orbit-ring-2">
                    <div class="orbit-dot"></div>
                </div>
            </div>
        </div>

        <div class="scroll-indicator">
            <div class="scroll-dot"></div>
        </div>
    </div>

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

        const langButtons = document.querySelectorAll('.lang-btn');
        langButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const lang = btn.dataset.lang;
                if (lang === currentLang) return;
                langButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
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

        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const particles = Array.from({ length: 60 }, () => ({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            size: Math.random() * 2 + 0.5,
            speedX: (Math.random() - 0.5) * 0.3,
            speedY: (Math.random() - 0.5) * 0.3,
            opacity: Math.random() * 0.5 + 0.2
        }));

        function animate() {
            ctx.fillStyle = '#0a0a0a';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            particles.forEach(p => {
                p.x += p.speedX;
                p.y += p.speedY;

                if (p.x < 0 || p.x > canvas.width) p.speedX *= -1;
                if (p.y < 0 || p.y > canvas.height) p.speedY *= -1;

                ctx.beginPath();
                ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(255, 0, 0, ${p.opacity})`;
                ctx.shadowBlur = 10;
                ctx.shadowColor = '#ff0000';
                ctx.fill();
                ctx.shadowBlur = 0;
            });

            requestAnimationFrame(animate);
        }

        animate();

        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            const textOpacity = Math.max(0, 1 - scrollY / 300);
            document.getElementById('textContent').style.opacity = textOpacity;
            document.getElementById('logoContainer').style.opacity = textOpacity;
        });

        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
    </script>
</body>
</html>
