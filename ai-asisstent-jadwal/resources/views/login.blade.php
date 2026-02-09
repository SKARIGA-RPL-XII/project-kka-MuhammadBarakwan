<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abang AI - Login & Daftar</title>
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
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Container */
        .auth-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* Left Side - Form */
        .auth-left {
            background: #ffffff;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .home-btn {
            position: absolute;
            top: 2rem;
            left: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: #f5f5f5;
            border: none;
            border-radius: 10px;
            color: #1a1a1a;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            z-index: 100;
        }

        .home-btn:hover {
            background: #E31E24;
            color: #ffffff;
            transform: translateY(-2px);
        }

        .auth-form-container {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 10;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 3rem;
        }

        .logo-box {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #E31E24, #C41E3A);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #ffffff;
            font-size: 1.3rem;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1a1a1a;
            letter-spacing: -0.02em;
        }

        .logo-subtitle {
            font-size: 0.85rem;
            color: #666;
            margin-top: -0.25rem;
        }

        .auth-header {
            margin-bottom: 2rem;
        }

        .auth-title {
            font-size: 2rem;
            font-weight: 800;
            color: #E31E24;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .auth-subtitle {
            color: #666;
            font-size: 0.95rem;
        }

        /* Tab Buttons */
        .tab-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .tab-btn {
            flex: 1;
            padding: 0.875rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            background: transparent;
            color: #666;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .tab-btn.active {
            background: #E31E24;
            color: #ffffff;
            border-color: #E31E24;
            box-shadow: 0 4px 12px rgba(227, 30, 36, 0.3);
        }

        /* Forms */
        .auth-form {
            display: none;
        }

        .auth-form.active {
            display: block;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            color: #1a1a1a;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            background: #ffffff;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            color: #1a1a1a;
            font-size: 0.95rem;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: #E31E24;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(227, 30, 36, 0.1);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .password-input-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 0.25rem;
        }

        .forgot-password {
            text-align: right;
            margin-top: -0.5rem;
            margin-bottom: 1.25rem;
        }

        .forgot-password a {
            color: #E31E24;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        .forgot-password a:hover {
            opacity: 0.8;
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #E31E24, #C41E3A);
            border: none;
            border-radius: 10px;
            color: #ffffff;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(227, 30, 36, 0.3);
            margin-top: 0.5rem;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(227, 30, 36, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
            color: #9ca3af;
            font-size: 0.85rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .google-btn {
            width: 100%;
            padding: 0.875rem;
            background: #ffffff;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            color: #1a1a1a;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .google-btn:hover {
            background: #ffffff;
            border-color: #E31E24;
        }

        .google-icon {
            width: 20px;
            height: 20px;
        }

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            margin-top: 2px;
            accent-color: #E31E24;
        }

        .checkbox-group label {
            color: #666;
            font-size: 0.85rem;
            line-height: 1.5;
            cursor: pointer;
        }

        .checkbox-group a {
            color: #E31E24;
            text-decoration: none;
            font-weight: 600;
        }

        .checkbox-group a:hover {
            text-decoration: underline;
        }

        .switch-form-text {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
            font-size: 0.9rem;
        }

        .switch-form-text a {
            color: #E31E24;
            font-weight: 600;
            text-decoration: none;
        }

        .switch-form-text a:hover {
            text-decoration: underline;
        }

        /* Right Side - Illustration */
        .auth-right {
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .illustration-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* AI Robot Illustration */
        .robot-illustration {
            text-align: center;
            position: relative;
            z-index: 10;
        }

        .robot-image {
            max-width: 650px;
            width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .robot-text {
            margin-top: 2rem;
            color: #1a1a1a;
            text-align: center;
        }

        .robot-text h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
            text-shadow: none;
            color: #E31E24;
        }

        .robot-text p {
            font-size: 1.1rem;
            opacity: 0.8;
            font-weight: 500;
            color: #4a5568;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .auth-container {
                grid-template-columns: 1fr;
            }

            .auth-right {
                display: none;
            }

            .auth-left {
                padding: 2rem 1.5rem;
            }

            .home-btn {
                top: 1rem;
                left: 1rem;
            }
        }

        @media (max-width: 640px) {
            .auth-title {
                font-size: 1.75rem;
            }

            .logo-section {
                margin-bottom: 2rem;
            }

            .tab-container {
                flex-direction: column;
                gap: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Left Side - Form -->
        <div class="auth-left">
            <a href="/dashboard" class="home-btn">
                <span>←</span>
                <span>Kembali ke Home</span>
            </a>

            <div class="auth-form-container">
                <div class="logo-section">
                    <div class="logo-box">AI</div>
                    <div>
                        <div class="logo-text">Abang AI</div>
                        <div class="logo-subtitle">Siap Lebih Pintar Mudah</div>
                    </div>
                </div>

                <div class="auth-header">
                    <h1 class="auth-title" id="authTitle">Masuk</h1>
                    <p class="auth-subtitle" id="authSubtitle">Mulai pengiriman melalui Abang AI!</p>
                </div>

                <div class="tab-container">
                    <button class="tab-btn active" data-tab="login">Login</button>
                    <button class="tab-btn" data-tab="register">Register</button>
                </div>

                <!-- Login Form -->
                <form class="auth-form active" id="loginForm">
                    <div class="form-group">
                        <label class="form-label">Nomor Telepon Atau Email</label>
                        <input type="text" class="form-input" placeholder="nama@email.com atau 08123456789" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kata Sandi</label>
                        <div class="password-input-wrapper">
                            <input type="password" class="form-input" id="loginPassword" placeholder="Masukkan kata sandi" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('loginPassword')">👁️</button>
                        </div>
                    </div>

                    <div class="forgot-password">
                        <a href="#">Lupa Kata Sandi?</a>
                    </div>

                    <button type="submit" class="submit-btn">Lanjutkan</button>

                    <div class="divider">Atau gunakan akun</div>

                    <button type="button" class="google-btn" id="googleLoginBtn">
                        <svg class="google-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span>Google</span>
                    </button>

                    <div class="switch-form-text">
                        Tidak memiliki akun? <a href="#" onclick="switchToRegister(event)">Daftar Sekarang</a>
                    </div>
                </form>

                <!-- Register Form -->
                <form class="auth-form" id="registerForm">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-input" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input" placeholder="nama@email.com" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-input" placeholder="08123456789" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kata Sandi</label>
                        <div class="password-input-wrapper">
                            <input type="password" class="form-input" id="registerPassword" placeholder="Masukkan kata sandi" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('registerPassword')">👁️</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Konfirmasi Kata Sandi</label>
                        <div class="password-input-wrapper">
                            <input type="password" class="form-input" id="confirmPassword" placeholder="Konfirmasi kata sandi" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('confirmPassword')">👁️</button>
                        </div>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">
                            Saya setuju dengan <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>
                        </label>
                    </div>

                    <button type="submit" class="submit-btn">Lanjutkan</button>

                    <div class="divider">Atau gunakan akun</div>

                    <button type="button" class="google-btn" id="googleRegisterBtn">
                        <svg class="google-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span>Google</span>
                    </button>

                    <div class="switch-form-text">
                        Sudah punya akun? <a href="#" onclick="switchToLogin(event)">Masuk Sekarang</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side - Illustration -->
        <div class="auth-right">
            <div class="illustration-container">
                <div class="robot-illustration">
                    <img src="{{ asset('images/undraw_writing-online_x665.png') }}" alt="Abang AI Illustration" class="robot-image">
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switching
        const tabButtons = document.querySelectorAll('.tab-btn');
        const authForms = document.querySelectorAll('.auth-form');
        const authTitle = document.getElementById('authTitle');
        const authSubtitle = document.getElementById('authSubtitle');

        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetTab = btn.dataset.tab;
                switchTab(targetTab);
            });
        });

        function switchTab(tab) {
            tabButtons.forEach(b => b.classList.remove('active'));
            document.querySelector(`[data-tab="${tab}"]`).classList.add('active');

            authForms.forEach(form => {
                form.classList.remove('active');
                if (form.id === tab + 'Form') {
                    form.classList.add('active');
                }
            });

            if (tab === 'login') {
                authTitle.textContent = 'Masuk';
                authSubtitle.textContent = 'Mulai pengiriman melalui Abang AI!';
            } else {
                authTitle.textContent = 'Daftar';
                authSubtitle.textContent = 'Buat akun baru untuk memulai!';
            }
        }

        function switchToRegister(e) {
            e.preventDefault();
            switchTab('register');
        }

        function switchToLogin(e) {
            e.preventDefault();
            switchTab('login');
        }

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }

        // API Configuration
        const API_URL = 'http://localhost:8000/api';

        // Login Form
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const emailOrPhone = e.target.querySelector('input[type="text"]').value;
            const password = e.target.querySelector('input[type="password"]').value;
            const submitBtn = e.target.querySelector('.submit-btn');

            submitBtn.disabled = true;
            submitBtn.textContent = 'Memproses...';

            try {
                // Determine if input is email or phone
                const isEmail = emailOrPhone.includes('@');
                const payload = {
                    password: password
                };

                if (isEmail) {
                    payload.email = emailOrPhone;
                } else {
                    payload.phone = emailOrPhone;
                }

                const response = await fetch(`${API_URL}/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (data.success) {
                    localStorage.setItem('auth_token', data.data.token);
                    localStorage.setItem('user', JSON.stringify(data.data.user));
                    alert('Login berhasil!');
                    window.location.href = '/chat.html';
                } else {
                    alert(data.message || 'Login gagal. Periksa kredensial Anda.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Pastikan server Laravel berjalan.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Lanjutkan';
            }
        });

        // Register Form
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const inputs = e.target.querySelectorAll('.form-input');
            const name = inputs[0].value;
            const email = inputs[1].value;
            const phone = inputs[2].value;
            const password = inputs[3].value;
            const password_confirmation = inputs[4].value;
            const submitBtn = e.target.querySelector('.submit-btn');

            if (password !== password_confirmation) {
                alert('Password tidak cocok!');
                return;
            }

            submitBtn.disabled = true;
            submitBtn.textContent = 'Memproses...';

            try {
                const response = await fetch(`${API_URL}/register`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name,
                        email,
                        phone,
                        password,
                        password_confirmation
                    })
                });

                const data = await response.json();

                if (data.success) {
                    localStorage.setItem('auth_token', data.data.token);
                    localStorage.setItem('user', JSON.stringify(data.data.user));
                    alert('Registrasi berhasil!');
                    window.location.href = '/chat.html';
                } else {
                    if (data.errors) {
                        const errorMessages = Object.values(data.errors).flat().join('\n');
                        alert(errorMessages);
                    } else {
                        alert(data.message || 'Registrasi gagal.');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Pastikan server Laravel berjalan.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Lanjutkan';
            }
        });

        // Google Authentication
        document.getElementById('googleLoginBtn').addEventListener('click', () => {
            window.location.href = `${API_URL}/auth/google`;
        });

        document.getElementById('googleRegisterBtn').addEventListener('click', () => {
            window.location.href = `${API_URL}/auth/google`;
        });
    </script>
</body>
</html>
